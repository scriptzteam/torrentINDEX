<?php
define('indirect', 1);
require_once ((dirname(__FILE__)) . '/app.php');
require_once ((dirname(__FILE__)) . '/vendor/torrent-rw.php');
require_once ((dirname(__FILE__)) . '/vendor/functions.php');

if (! isset($_GET['id'])) {
    die('A torrent ID must be specified.');
}

$id = $_GET['id'];

$found = false;

foreach (scan('./torrents', 'torrent') as $f) {
    $file = $f;
    $torrent = new Torrent($f);
    if ($torrent->hash_info() == $id) {
        $found = true;
        break;
    }
}

if (! $found) {
    die('That torrent ID was invalid. No file was found in <code>./torrents/</code> - try again!');
}

$announce = $torrent->announce();
$comment = $torrent->comment();
$content = $torrent->content();
$magnet_html = $torrent->magnet(true);
$name = $torrent->name();
$size = $torrent->size();

require_once ('./vendor/sty.header.php');
?>
<div class="container">
	<br>
	<ul class="nav nav-pills">
		<li><a href="./index.php">home</a></li>
		<li><a href="./search.php">search</a></li>
		<li class="active"><a href="#">torrent - <?php echo ($name); ?></a></li>
	</ul>
	<br>
	<h2>
		<?php echo ($name); ?>
	</h2>
	<br> <br> <br>
	<p align="center">
		<a href="<?php echo ($file); ?>"><button class="btn btn-default">download
				.torrent</button></a> <a href="<?php echo ($magnet_html); ?>"><button
				class="btn btn-default">
				<i class="fa fa-magnet"></i>&nbsp;&nbsp;magnet link
			</button></a>
	</p>
	<br>
	<table style="width: 100%;">
		<tr>
			<td>Torrent name:</td>
			<td><?php echo ($name); ?></td>
		</tr>
		<tr>
			<td>Announce URL:</td>
			<td><?php echo ($announce); ?></td>
		</tr>
		<tr>
			<td>Comment:</td>
			<td><?php echo ($comment); ?></td>
		</tr>
		<tr>
			<td>Size:</td>
			<td><?php echo (human_filesize($size)); ?></td>
		</tr>
		<tr>
			<td>Files:</td>
			<td>
				<div id="spoiler" style="display: none">
					<br><?php
    foreach ($content as $f => $value) {
        
        echo ('&nbsp;&nbsp;&nbsp;&nbsp;' . $f . ' [' . human_filesize($value) . ']' . '<br>');
    }
    ?>
				</div> <br> &nbsp;&nbsp;
				<button class="btn btn-default"
					onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}">Show/hide
					files</button> <br> <br>
			</td>
		</tr>
	</table>
</div>
<?php
require_once ((dirname(__FILE__)) . '/vendor/sty.footer.php');
?>
