<html>
<body>
<div id="box">
  <div id="title">
  <?php
  echo nl2br(htmlentities(file_get_contents("./data/splash.txt")));
  ?>
  </div>
  </div>
</body>
<style>
@font-face {
	font-family: fontpacchi;
	src: url(font.ttf);
}
body { height: 100%; margin: 0; padding: 0; }
html { height: 100%; }
#box { background-color: #ffff00; width: 100%; min-height: 100%; margin: auto; }
#title { color: #000000; text-align: center; font-size: 5vw; font-family:fontpacchi; display: flex; justify-content: center; align-items: center; height: 100vh; }
</style>
</html>
