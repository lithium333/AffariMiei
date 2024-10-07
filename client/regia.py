#!/usr/bin/python3

import json
import tkinter as tk
from tkinter import ttk
from tkinter import messagebox
import requests
import urllib.parse
import playsound

ip_addr="127.0.0.1"

def center_window(window):
	window.update_idletasks()
	width = window.winfo_width()
	height = window.winfo_height()
	screen_width = window.winfo_screenwidth()
	screen_height = window.winfo_screenheight()
	x = (screen_width - width) // 2
	y = (screen_height - height) // 2
	window.geometry(f"{width}x{height}+{x}+{y}")

def apripacco(col,row):
	print("issuing: http://"+ip_addr+"/write.php?col="+str(col)+"&row="+str(row))
	requests.get("http://"+ip_addr+"/write.php?col="+str(col)+"&row="+str(row))
	window.destroy()

def toglireg(col,row):
	print("issuing: http://"+ip_addr+"/remreg.php?col="+str(col)+"&row="+str(row))
	requests.get("http://"+ip_addr+"/remreg.php?col="+str(col)+"&row="+str(row))
	window.destroy()

def delofferta():
	requests.get("http://"+ip_addr+"/remove.php")
	window.destroy()
	
def accofferta():
	requests.get("http://"+ip_addr+"/accetta.php")
	window.destroy()
	
def faiofferta():
	item = ent_offer.get()
	itemu = urllib.parse.quote_plus(item)
	if(len(item)>0):
		requests.get("http://"+ip_addr+"/propose.php?val="+itemu)
	window.destroy()

def playaudio(s):
	window.destroy()
	playsound.playsound(s,False)
	
def modereg():
	requests.get("http://"+ip_addr+"/modereg.php")
	window.destroy()
def modepac():
	try:
		fobj = open("partite.txt")
	except:
		fobj = []
	
	requests.get("http://"+ip_addr+"/azzera.php")
	for riga in fobj:
		riga = riga.rstrip()
		rigav = riga.split(",")
		col = int(rigav[0])
		row = int(rigav[1])
		requests.get("http://"+ip_addr+"/write.php?col="+str(col)+"&row="+str(row))
	window.destroy()

while(True):
	# MAIN LOOP
	window = tk.Tk()
	window.call('wm', 'attributes', '.', '-topmost', '1')
	window.title("Affari Miei MGR")
	window.geometry('1000x900') 
	window.protocol('WM_DELETE_WINDOW', lambda: exit())
	
	# JSON LOAD
	jrqst = requests.get("http://"+ip_addr+"/data/pacchi.json")
	jdata = json.loads(jrqst.text)
	
	if(not jdata[7]):
		lb = tk.Label(window, bg='white', width=20, text='PACCHI BLU:')
		lb.place(x=100,y=40)
		lr = tk.Label(window, bg='white', width=20, text='PACCHI ROSSI:')
		lr.place(x=400,y=40)
	else:
		lb = tk.Label(window, bg='white', width=20, text='CONTRADE:')
		lb.place(x=100,y=40)
	la = tk.Label(window, bg='white', width=20, text='PLAY:')
	la.place(x=700,y=40)

	# PREPARE ARRAYS
	arr_cbox_b = []
	arr_cbox_r = []

	totpacchi=0
	last_valido=[0,0]

	if(jdata[7]):
		for cnt in range(0,15):
			exec("arr_cbox_b.append(tk.Button(master=window, bg='yellow', fg='black', text=jdata[5][cnt][\"desc\"], command=lambda: toglireg(0,"+str(cnt)+")))")
			arr_cbox_b[cnt].place(x=100,y=100+cnt*40)
			if(not jdata[5][cnt]["show"]):
				arr_cbox_b[cnt].config(state="disabled")
				arr_cbox_b[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=0
				last_valido[1]=cnt
			print(str(cnt)+" : "+jdata[0][cnt]["desc"])
		for cnt in range(0,15):
			exec("arr_cbox_r.append(tk.Button(master=window, bg='yellow', fg='black', text=jdata[6][cnt][\"desc\"], command=lambda: toglireg(1,"+str(cnt)+")))")
			arr_cbox_r[cnt].place(x=400,y=100+cnt*40)
			if(not jdata[6][cnt]["show"]):
				arr_cbox_r[cnt].config(state="disabled")
				arr_cbox_r[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=1
				last_valido[1]=cnt
			print(str(cnt)+" : "+jdata[1][cnt]["desc"])
	else:
		print("\nBLU:")
		for cnt in range(0,15):
			exec("arr_cbox_b.append(tk.Button(master=window, bg='blue', fg='white', text=jdata[0][cnt][\"desc\"], command=lambda: apripacco(0,"+str(cnt)+")))")
			arr_cbox_b[cnt].place(x=100,y=100+cnt*40)
			if(not jdata[0][cnt]["show"]):
				arr_cbox_b[cnt].config(state="disabled")
				arr_cbox_b[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=0
				last_valido[1]=cnt
			print(str(cnt)+" : "+jdata[0][cnt]["desc"])
		print("\nROSSI:")
		for cnt in range(0,15):
			exec("arr_cbox_r.append(tk.Button(master=window, bg='red', fg='white', text=jdata[1][cnt][\"desc\"], command=lambda: apripacco(1,"+str(cnt)+")))")
			arr_cbox_r[cnt].place(x=400,y=100+cnt*40)
			if(not jdata[1][cnt]["show"]):
				arr_cbox_r[cnt].config(state="disabled")
				arr_cbox_r[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=1
				last_valido[1]=cnt
			print(str(cnt)+" : "+jdata[1][cnt]["desc"])
		print("\nPACCHI: "+str(totpacchi))
		# OFFERTA
		if(jdata[3]!=None):
			butt_del = tk.Button(master=window, bg='orange', text="RIMUOVI OFFERTA", command=lambda: delofferta())
			butt_del.place(x=100,y=750)
			if(not jdata[4]):
				butt_acc = tk.Button(master=window, bg='lime', text="ACCETTA OFFERTA", command=lambda: accofferta())
				butt_acc.place(x=400,y=750)
			desc_offer = tk.Button(master=window, bg='yellow', text="OFFERTA: "+jdata[3], state='disabled')
			if(jdata[4]):
				desc_offer.config(bg="lime")
			desc_offer.place(x=700,y=750)
		else:
			butt_del = tk.Button(master=window, bg='yellow', text="FAI OFFERTA", command=lambda: faiofferta())
			butt_del.place(x=100,y=750)
			ent_offer = tk.Entry(window, width=20)
			ent_offer.place(x=400,y=750)
	
	# LOAD BOTTONI SUONI
	acfg_file = open("sound.cfg")
	abutn=0
	abutv=[]
	for riga in acfg_file:
		riga = riga.rstrip()
		args = riga.split(",")
		exec("abutv.append(tk.Button(master=window, bg='black', fg='white', text=args[0], command=lambda: playaudio(\"./sound/"+args[1]+"\")))")
		
		abutv[abutn].place(x=700,y=100+abutn*40)
		abutn+=1
	
	# SEPARATORI
	sep0 = ttk.Separator(window)
	sep0.pack(side="bottom",fill="x", padx=5, pady=85)
	sep1 = ttk.Separator(window)
	sep1.pack(side="bottom",fill="x", padx=5, pady=0)
	
	# CONTRADA FORTUNATA
	if(jdata[7]):
		butt_contrada = tk.Button(master=window, bg='black', fg='white', text="AZZERA (MOD. PACCHI)", command=lambda: modepac())
		butt_contrada.place(x=100,y=840)
	else:
		butt_contrada = tk.Button(master=window, bg='black', fg='white', text="CONTRADA FORTUNATA", command=lambda: modereg())
		butt_contrada.place(x=100,y=840)
		
	# EXIT: partita finita
	if(totpacchi<2):
		window.destroy();
		messagebox.showinfo("PARTITA TERMINATA", "Il pacco mancante sta per essere memorizzato sul file.")
		fobj = open("partite.txt","a")
		fobj.write(str(last_valido[0])+","+str(last_valido[1])+"\n")
		fobj.close()
		exit()
	
	window.mainloop()

		


# DIMSESSO
#try:
#	c1 = int(input("\ncolonna: "))
#	if(c1==-1):
#		running=False
#except:
#	c1=-2
#try:
#	c2 = int(input("riga: "))
#	if(c2==-1):
#		running=False
#except:
#	c2=-2


#if(c1>=0 and c2>=0 and c1<2 and c2<15 and running):
#	requests.get("http://"+ip_addr+"/write.php?col="+str(c1)+"&row="+str(c2))
