To generate DB (pacchi.json):

- create a table (using Excel or O.O./L.O. Calc) for both boxes and "contrade"(villages) in this way:
blue box 1,red box 1
...
blue box 15,red box 15

- export in CSV using no delimiters and "," as separator, and check if syntax is similar to EXAMPLE.CSV (file names must be CONTRADE.csv and PACCHI.csv), if a box/village name uses "," in its name, use ";" as separator and change conv.py accordingly

- run conv.py and pacchi.json will appear in the same folder

- copy pacchi.json as data/pacchi.json in the srv directory
