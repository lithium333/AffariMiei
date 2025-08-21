#!/usr/bin/python3

import json
import requests
import tkinter as tk
from tkinter import filedialog
import urllib.parse

### INDIRIZZO IP SERVER ###
ip_addr = "127.0.0.1"

# Seleziona file
csv_fname = filedialog.askopenfilename(filetypes= [('Text CSV','.csv')])
print("\nFile:\n"+csv_fname)

# Parsing
riga0 = True
rigaN = 0
pacchi_blu=[]
pacchi_rossi=[]
with open(csv_fname,"r") as csv_fobj:
	for riga in csv_fobj:
		if(riga0):
			print("DEBUG: first line:\n"+riga)
			riga0 = False
		else:
			args = (riga.rstrip()).split(",")
			pacchi_blu+=[args[0]]
			pacchi_rossi+=[args[1]]
			rigaN=rigaN+1

# Pack JSON & REQ
jdata_req = {}
jdata_req["B"] = pacchi_blu
jdata_req["R"] = pacchi_rossi
jdata_req["N"] = rigaN
jtxt_req = json.dumps(jdata_req)
print("DEBUG JDATA: "+jtxt_req)
requests.get("http://"+ip_addr+"/loadRegioni.php?data="+urllib.parse.quote_plus(jtxt_req))
