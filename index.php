<?php
define('indirect', 1);
require_once ((dirname(__FILE__)) . '/app.php');
require_once ((dirname(__FILE__)) . '/vendor/torrent-rw.php');
require_once ((dirname(__FILE__)) . '/vendor/functions.php');
require_once ((dirname(__FILE__)) . '/vendor/sty.header.php');
?>
<div class="container">
	<div class="page-header">
		<h1>torrent[INDEX]</h1>
	</div>
	<br>
	<ul class="nav nav-pills">
		<li class="active"><a href="#">home</a></li>
		<li><a href="./search.php">search</a></li>
	</ul>
	<br> <br>
<?php
$i = scan('./torrents', 'torrent');
if (count($i) == 0) {
    die('No torrents found. Add some to <code>./torrents/</code> for them to show up here.');
}
?>
	<table style="width: 100%;">
		<tr>
			<th>Torrent name</th>
			<th>Torrent size</th>
			<th>.torrent</th>
			<th>Magnet link</th>
		</tr>
	<?php
foreach ($i as $f) {
    displayTorrent($f);
}
?></table>
</div>
<?php require_once ((dirname ( __FILE__ )) . '/vendor/sty.footer.php'); ?>
