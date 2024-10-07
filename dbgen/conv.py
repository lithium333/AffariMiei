#!/usr/bin/python3

import json
import time
import os
path_db = "pacchi.json"


jdata = [[],[],time.time(),None,False,[],[],False,False]

# PACCHI
ftxt = open("PACCHI.csv")
cnt=0
for riga in ftxt:
	riga = riga.rstrip()
	campi = riga.split(",")
	jdata[0].append({})
	jdata[1].append({})
	jdata[0][cnt]["desc"]=campi[0]
	jdata[0][cnt]["show"]=True
	jdata[1][cnt]["desc"]=campi[1]
	jdata[1][cnt]["show"]=True
	cnt+=1

# CONTRADE
ftxt = open("CONTRADE.csv")
cnt=0
for riga in ftxt:
	riga = riga.rstrip()
	campi = riga.split(",")
	jdata[5].append({})
	jdata[6].append({})
	jdata[5][cnt]["desc"]=campi[0]
	jdata[5][cnt]["show"]=True
	jdata[6][cnt]["desc"]=campi[1]
	jdata[6][cnt]["show"]=True
	cnt+=1

# WRITE DB
fjson = open(path_db,"w")
json.dump(jdata,fjson,indent=2)
fjson.close()
os.chmod(path_db, 0o0777)
