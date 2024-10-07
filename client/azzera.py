#!/usr/bin/python3

import requests
from tkinter import messagebox

ip_addr="127.0.0.1"
requests.get("http://"+ip_addr+"/azzera.php")

try:
	fobj = open("partite.txt")
except:
	fobj = []


for riga in fobj:
	riga = riga.rstrip()
	rigav = riga.split(",")
	col = int(rigav[0])
	row = int(rigav[1])
	requests.get("http://"+ip_addr+"/write.php?col="+str(col)+"&row="+str(row))

messagebox.showinfo("TABELLONE AZZERATO", "Il tabellone è stato riportato pieno (tranne i pacchi i vinti memorizzati sul file)")
	
