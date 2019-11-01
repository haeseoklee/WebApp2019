<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		
		<!-- Ex 1: Number of Songs (Variables) -->
		<?php $song_count = 3004 ?>
		<p>
			I love music.
			I have <?= $song_count ?> total songs,
			which is over <?= (int)($song_count/10) ?> hours of music!
		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
		
			<ol>
			<?php 
			$newspages = (int) $_GET["newspages"];
			if (isset($newspages)){
				$newspages = 5;
			}
			?>

			<?php for($i=11; $i>11-$newspages; $i--) {
				if ($i<10){
					$num = '0'.$i;
				} else {
					$num = $i;
				}?>
			    <li><a href="https://www.billboard.com/archive/article/2019<?=$num?>">2019-<?=$num?></a></li>
			<?php }?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<?php $artists = array("Guns N' Roses", "Green Day", "Blink182", "Queen", "Lovelyz");?>
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php foreach(file("favorite.txt") as $artist) {?>
				<li><a href="http://en.wikipedia.org/wiki/<?=$artist?>"><?=$artist?></a></li>
				<?php }?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<?php $mp3_files = glob("lab5/musicPHP/songs/*.mp3");?>
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
			<ul id="musiclist">
			<?php 
			$temp = array();
			foreach($mp3_files as $file) {
				$file_size = floor(filesize($file) / 1024);
				$temp[$file] = $file_size;
			}
			arsort($temp);?>	
			<?php foreach($temp as $key => $value) {?>
				<li class="mp3item">
					<a href="<?=$key?>"><?=basename($key)?> (<?= $value ?>KB)</a>
				</li>
			<?php } ?>
				<!-- Exercise 8: Playlists (Files) -->
				<?php $m3u_files = glob("lab5/musicPHP/songs/*.m3u");?>
				<?php 
				$temp2 = array();
				foreach($m3u_files as $file) {
					$temp2[$file] = basename($file);
				}
				arsort($temp2);?>
				<?php foreach($temp2 as $key => $value) { ?>
				<li class="playlistitem"><?=$value?>:
					<ul>
						<?php 
						$file = file($key);
						shuffle($file);
						foreach($file as $content){?>
							<?php if(strpos($content, "#") === false){ ?>
								<li><?= $content ?></li>
							<?php } ?>
						<?php }?>
					</ul>
				</li>
				<?php }?>
			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
