#!/usr/bin/python3

import json
import sys,os
import tkinter as tk
from tkinter import ttk
from tkinter import messagebox
import requests
import urllib.parse
import playsound3

# SETTINGS
ip_addr="127.0.0.1"
relpath=os.path.dirname(sys.argv[0])

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
	if(totpacchi>1):
		print("issuing: http://"+ip_addr+"/write.php?col="+str(col)+"&row="+str(row))
		requests.get("http://"+ip_addr+"/write.php?col="+str(col)+"&row="+str(row))
	else:
		print("issuing: http://"+ip_addr+"/writesol.php?col="+str(col)+"&row="+str(row))
		requests.get("http://"+ip_addr+"/writesol.php?col="+str(col)+"&row="+str(row))
	window.destroy()
	drwFrame()

def toglireg(col,row):
	print("issuing: http://"+ip_addr+"/remreg.php?col="+str(col)+"&row="+str(row))
	requests.get("http://"+ip_addr+"/remreg.php?col="+str(col)+"&row="+str(row))
	window.destroy()
	drwFrame()

def delofferta():
	requests.get("http://"+ip_addr+"/remove.php")
	window.destroy()
	drwFrame()
	
def accofferta():
	requests.get("http://"+ip_addr+"/accetta.php")
	window.destroy()
	drwFrame()
	
def faiofferta():
	item = ent_offer.get()
	itemu = urllib.parse.quote_plus(item)
	if(len(item)>0):
		requests.get("http://"+ip_addr+"/propose.php?val="+itemu)
	window.destroy()
	drwFrame()

def playaudio(s):
	playsound3.playsound(s,False)
	
def modereg():
	requests.get("http://"+ip_addr+"/modereg.php")
	window.destroy()
	drwFrame()

def azzera():
	#try:
	#	fobj = open("partite.txt")
	#except:
	#	fobj = []
	#
	requests.get("http://"+ip_addr+"/azzera.php")
	#for riga in fobj:
	#	riga = riga.rstrip()
	#	rigav = riga.split(",")
	#	col = int(rigav[0])
	#	row = int(rigav[1])
	#	requests.get("http://"+ip_addr+"/write.php?col="+str(col)+"&row="+str(row))
	window.destroy()
	drwFrame()

def splashON():
	requests.get("http://"+ip_addr+"/splashon.php")
	window.destroy()
	drwFrame()

def splashOFF():
	requests.get("http://"+ip_addr+"/splashoff.php")
	window.destroy()
	drwFrame()

def drwFrame():
	global window
	window = tk.Frame(windowParent,bg="#B0E0FF",height = hparam, width = 1000)
	
	# JSON LOAD
	jrqst = requests.get("http://"+ip_addr+"/data/pacchi.json")
	jdata = json.loads(jrqst.text)
	if(not jdata[7]):
		lb = tk.Label(window, bg='white', width=20, font="15",text='PACCHI BLU:')
		lb.place(x=100,y=40)
		lr = tk.Label(window, bg='white', width=20, font="15",text='PACCHI ROSSI:')
		lr.place(x=400,y=40)
	else:
		lb = tk.Label(window, bg='white', width=20, font="15",text='CONTRADE:')
		lb.place(x=100,y=40)
	la = tk.Label(window, bg='white', width=20, font="15",text='PLAY:')
	la.place(x=700,y=40)

	# PREPARE ARRAYS
	arr_cbox_b = []
	arr_cbox_r = []
	
	global totpacchi
	totpacchi=0
	last_valido=[0,0]

	if(jdata[7]):
		# REGIONI SINISTRA
		for cnt in range(0,jdata[11]):
			exec("arr_cbox_b.append(tk.Button(master=window, bg='yellow', fg='black', font='12', height=1,text=jdata[5][cnt][\"desc\"], command=lambda: toglireg(0,"+str(cnt)+")))")
			arr_cbox_b[cnt].place(x=100,y=100+cnt*30,h=30)
			if(not jdata[5][cnt]["show"]):
				arr_cbox_b[cnt].config(state="disabled")
				arr_cbox_b[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=0
				last_valido[1]=cnt
		# REGIONI DESTRA
		for cnt in range(0,jdata[11]):
			exec("arr_cbox_r.append(tk.Button(master=window, bg='yellow', fg='black', font='12', height=1,text=jdata[6][cnt][\"desc\"], command=lambda: toglireg(1,"+str(cnt)+")))")
			arr_cbox_r[cnt].place(x=400,y=100+cnt*30,h=30)
			if(not jdata[6][cnt]["show"]):
				arr_cbox_r[cnt].config(state="disabled")
				arr_cbox_r[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=1
				last_valido[1]=cnt
	else:
		# PACCHI BLU
		for cnt in range(0,jdata[10]):
			exec("arr_cbox_b.append(tk.Button(master=window, bg='blue', fg='white', font='10', text=jdata[0][cnt][\"desc\"], command=lambda: apripacco(0,"+str(cnt)+")))")
			arr_cbox_b[cnt].place(x=100,y=100+cnt*30,h=30)
			if(not jdata[0][cnt]["show"]):
				arr_cbox_b[cnt].config(state="disabled")
				arr_cbox_b[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=0
				last_valido[1]=cnt
		# PACCI ROSSI
		for cnt in range(0,jdata[10]):
			exec("arr_cbox_r.append(tk.Button(master=window, bg='red', fg='white', font='10', text=jdata[1][cnt][\"desc\"], command=lambda: apripacco(1,"+str(cnt)+")))")
			arr_cbox_r[cnt].place(x=400,y=100+cnt*30,h=30)
			if(not jdata[1][cnt]["show"]):
				arr_cbox_r[cnt].config(state="disabled")
				arr_cbox_r[cnt].config(bg="white")
			else:
				totpacchi+=1
				last_valido[0]=1
				last_valido[1]=cnt
		# OFFERTA
		hposOffer=maxextrarows*30+415;
		if(jdata[3]!=None):
			butt_del = tk.Button(master=window, bg='orange', font='12',text="RIMUOVI OFFERTA", command=lambda: delofferta())
			butt_del.place(x=100,y=hposOffer,h=30)
			if(not jdata[4]):
				butt_acc = tk.Button(master=window, bg='lime', font='12',text="ACCETTA OFFERTA", command=lambda: accofferta())
				butt_acc.place(x=400,y=hposOffer,h=30)
			desc_offer = tk.Button(master=window, bg='yellow', font='12',text="OFFERTA: "+jdata[3], state='disabled')
			if(jdata[4]):
				desc_offer.config(bg="lime")
			desc_offer.place(x=700,y=hposOffer,h=30)
		else:
			butt_del = tk.Button(master=window, bg='yellow', font='12',text="FAI OFFERTA", command=lambda: faiofferta())
			butt_del.place(x=100,y=hposOffer,h=30)
			global ent_offer
			ent_offer = tk.Entry(window, width=20, font='12')
			ent_offer.place(x=400,y=hposOffer,h=30)
			
		# SEPARATORI
		hposSep0=maxextrarows*30+410;
		sep0 = ttk.Separator(window, orient='horizontal')
		#sep0.pack(side="bottom",fill="x", padx=5, pady=85)
		sep0.place(x=0, y=hposSep0, relwidth=1, height=1)
		hposSep1=maxextrarows*30+450;
		sep1 = ttk.Separator(window, orient='horizontal')
		#sep1.pack(side="bottom",fill="x", padx=5, pady=0)
		sep1.place(x=0, y=hposSep1, relwidth=1, height=1)
	
	# LOAD BOTTONI SUONI
	acfg_file = open(relpath+"/sound.cfg")
	abutn=0
	abutv=[]
	for riga in acfg_file:
		riga = riga.rstrip()
		args = riga.split(",")
		exec("abutv.append(tk.Button(master=window, bg='black', fg='white', font='12',text=args[0], command=lambda: playaudio(\""+relpath+"/sound/"+args[1]+"\")))")
		
		abutv[abutn].place(x=700,y=100+abutn*30,h=30)
		abutn+=1
	
	# CONTRADA FORTUNATA
	hposContrada=maxextrarows*30+460;
	if(jdata[7]):
		butt_contrada = tk.Button(master=window, bg='#CF5F00', fg='white', font='12',text="AZZERA (MOD. PACCHI)", command=lambda: azzera())
		butt_contrada.place(x=100,y=hposContrada,h=30)
		if(jdata[8]):
			butt_contrada2 = tk.Button(master=window, bg='black', fg='white', font='12',text="SPLASH OFF REGIONE", command=lambda: splashOFF())
			butt_contrada2.place(x=400,y=hposContrada,h=30)
		else:
			butt_contrada2 = tk.Button(master=window, bg='black', fg='white', font='12',text="SPLASH ON REGIONE", command=lambda: splashON())
			butt_contrada2.place(x=400,y=hposContrada,h=30)
	else:
		butt_contrada = tk.Button(master=window, bg='#CF5F00', fg='white', font='12',text="AZZERA", command=lambda: azzera())
		butt_contrada.place(x=100,y=hposContrada,h=30)
		butt_contrada2 = tk.Button(master=window, bg='black', fg='white', font='12',text="CONTRADA FORTUNATA", command=lambda: modereg())
		butt_contrada2.place(x=400,y=hposContrada,h=30)
		
	# EXIT: partita finita (DISABLED)
	#if(totpacchi<2):
	#	window.destroy();
	#	messagebox.showinfo("PARTITA TERMINATA", "Il pacco mancante sta per essere memorizzato sul file.")
	#	fobj = open("partite.txt","a")
	#	fobj.write(str(last_valido[0])+","+str(last_valido[1])+"\n")
	#	fobj.close()
	#	exit()
	window.pack()
	window.pack_propagate(0)
	
	
# INITIAL SETTINGS
jinitrqst = requests.get("http://"+ip_addr+"/data/pacchi.json")
jinitdata = json.loads(jinitrqst.text)
global maxextrarows
maxextrarows = max(jinitdata[10],jinitdata[11])-10
global hparam
hparam=str(500+30*maxextrarows)
windowParent = tk.Tk()
windowParent.call('wm', 'attributes', '.', '-topmost', '1')
windowParent.title("Affari Miei MGR")
windowParent.geometry('1000x'+hparam)
windowParent.resizable(False, False) 
windowParent.protocol('WM_DELETE_WINDOW', lambda: exit())

# MAIN LOOP
while(True):
	drwFrame()	
	windowParent.mainloop()
