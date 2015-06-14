<?php
define('indirect', 1);
require_once ((dirname(__FILE__)) . '/app.php');
require_once ((dirname(__FILE__)) . '/vendor/torrent-rw.php');
require_once ((dirname(__FILE__)) . '/vendor/functions.php');
require_once ((dirname(__FILE__)) . '/vendor/sty.header.php');

if (! isset($_GET['query'])) {
    ?>
<div class="container">
	<br> <br>
	<ul class="nav nav-pills">
		<li><a href="./index.php">home</a></li>
		<li class="active"><a href="#">search</a></li>
	</ul>
	<br> <br>
	<div class="row">
		<div class="col-lg-12">
			<form action="search.php" method="get">
				<div class="input-group">
					<input name="query" type="text" class="form-control"
						placeholder="search"> <span class="input-group-btn">
						<button class="btn btn-default" type="submit">find</button>
					</span>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
    require_once ((dirname(__FILE__)) . '/vendor/sty.footer.php');
    die();
}

$query = $_GET['query'];
$results = array();

foreach (scan('./torrents', 'torrent') as $f) {
    $file = $f;
    $torrent = new Torrent($f);
    if (preg_match('/' . $query . '/i', $torrent->name())) {
        array_push($results, $f);
    }
}
?>
<div class="container">
	<div class="page-header">
		<h1>torrent[INDEX]</h1>
	</div>
	<br>
	<ul class="nav nav-pills">
		<li><a href="./index.php">home</a></li>
		<li><a href="./search.php">search</a></li>
		<li class="active"><a href="#">search - <?php echo ($query); ?></a></li>
	</ul>
	<br> <br>
<?php if (! empty ( $results )) {?>
	<table style="width: 100%;">
		<tr>
			<th>Torrent name</th>
			<th>Torrent size</th>
			<th>.torrent</th>
			<th>Magnet link</th>
		</tr>
		<?php
    foreach ($results as $r) {
        displayTorrent($r);
    }
    ?>
			</table>
			<?php
} else {
    ?>
	<p align="center">No results found.</p>
	<?php
}
?>
</div>
<?php require_once ('./vendor/sty.footer.php'); ?>
