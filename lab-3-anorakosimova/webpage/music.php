<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>

		<div id="listarea"><!-- 
			<ul id="musiclist">
				<li class="mp3item">
					<a href="songs/Be More.mp3">Be More.mp3</a>
					(5438375 b)
				</li>

				<li class="mp3item">
					<a href="songs/Drift Away.mp3">Drift Away.mp3</a>
					(5724612 b)
				</li>

				<li class="mp3item">
					<a href="songs/Hello.mp3">Hello.mp3</a>

					(1871110 b)
				</li>

				<li class="mp3item">
					<a href="songs/Panda Sneeze.mp3">Panda Sneeze.mp3</a>
					(58 b)
				</li>

				<li class="playlistitem">
					<a href="music.php?playlist=mypicks.txt">mypicks.txt</a>
				</li>

				<li class="playlistitem">
					<a href="music.php?playlist=playlist.txt">playlist.txt</a>
				</li>
			</ul> -->

			<ul>
				<?php 
				if(isset($_REQUEST["playlist"])){
					?>
					<a href="music.php">Back</a>
					<?php
					$list_of_music = explode("\n", file_get_contents($_REQUEST["playlist"]));
					
					foreach ($list_of_music as $key => $value) { 
						$size = filesize("songs/".$value);
						$type = "b";
						if($size>1023){
							$size=$size%1024;
							$type="kb";
						}
						if($size>1023){
							$size=$size%1024;
							$type="Mb";
						}
						?>
						<li class="mp3item"><a href="<?= "songs/".$value ?>"><?= basename($value) ?></a>(<?=$size." ".$type?>)</li>
					<?php
				}
				}else{
					$music_files = glob("songs/*.mp3");

					foreach ($music_files as $key => $value) { 
						$size = filesize($value);
						$type = "b";
						if($size>1023){
							$size=$size%1024;
							$type="kb";
						}
						if($size>1023){
							$size=$size%1024;
							$type="Mb";
						}
						?>
						<li class="mp3item"><a href="<?= $value ?>"><?= basename($value) ?></a>(<?=$size." ".$type?>)</li>

					<?php
					}

					$playlist_files = glob("songs/*.txt");
					foreach ($playlist_files as $key => $value) { ?>
						<li class="playlistitem"><a href="?playlist=<?= $value ?>"><?= basename($value) ?></a></li>
					<?php
					}
				}
				 ?>
			
			</ul>

		</div>
	</body>
</html>
