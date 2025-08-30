WALLPAPERS:

- wp_pacchi.png & wp_regioni.png must have the same resolution your public screen (e.g. the projector)
- it's important also important to use the same aspect ratio (4:3,16:9...) of the public screen


DATABASE:

Everything is stored in data/pacchi.json
[0] : BLUE BOXES LIST (type array)
[1] : RED BOXES LIST (type array)
[2] : TIMESTAMP of LAST WRITE (type string)
[3] : PROPOSAL DESCRIPTION (type string or null: if NOT PRESENT)
[4] : PROPOSAL ACCEPTED (type bool) 
[5] : LEFT REGIONS LIST (type array)
[6] : RIGHT REGIONS LIST (type array)
[7] : MODE IS "CONTRADA FORTUNATA" (REGIONS) (type bool)
[8] : REDIRECT view.php TO splash.php (type bool)
[9] : [col,row] SOLUTION ([-1,-1] IF NOT SET/PRESENT) (type array of 2 type int)
[10] : NUMBER OF ROWS PER COL. FOR BOXES (type int)
[11] : NUMBER OF ROWS FOR COL. FOR REGIONS (type int)
[12] : TITLE (DIRECTLY IN HTML FORMAT: IMG SRC SUPPORTED) (type string)
[13] : TITLE COLOR : BOXES MODE in HTML (type string)
[14] : TITLE COLOR : REGIONS MODE in HTML (type string)
