<?php
require_once '../vendor/autoload.php';
use scriptzteam\TorrentIndex as TI;

echo TI\Header::create();

if (!isset($_GET['query'])) {
    ?>
    <div class="container">
        <div class="page-header">
            <h1><?= TI\App::TI_NAME ?></h1>
        </div>
        <ul class="nav nav-pills">
            <li><a href="/">Home</a></li>
            <li class="active"><a>Search</a></li>
        </ul>
        <br> <br>
        <div class="row">
            <div class="col-lg-12">
                <form action="/search.php" method="get">
                    <div class="input-group">
                        <input name="query" type="text" class="form-control"
                               placeholder="search"> <span class="input-group-btn">
						<button class="btn btn-default" type="submit">Find</button>
					</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

} else {
    $query = $_GET['query'];
    $results = array();

    foreach (TI\Functions::scan('torrents', 'torrent') as $f) {
        $file = $f;
        $torrent = new TI\Torrent($f);
        if (preg_match('/'.$query.'/i', $torrent->name())) {
            array_push($results, $f);
        }
    } ?>
<div class="container">
    <div class="page-header">
        <h1><?= TI\App::TI_NAME ?></h1>
    </div>
    <ul class="nav nav-pills">
        <li><a href="/">Home</a></li>
        <li><a href="/search.php">Search</a></li>
        <li class="active"><a>Search - <?= $query ?></a></li>
    </ul>
    <br> <br>
    <?php if (!empty($results)) {
    ?>
        <table class="table table-bordered">
            <tr>
                <th>Torrent name</th>
                <th>Torrent size</th>
                <th>.torrent</th>
                <th>Magnet link</th>
            </tr>
            <?php
            foreach ($results as $r) {
                TI\Functions::displayTorrent($r);
            } ?>
        </table>
        <?php

} else {
    ?>
        <p align="center">No results found.</p>
        <?php

} ?>
</div>
<?php 
} ?>
<?= TI\Footer::create() ?>
