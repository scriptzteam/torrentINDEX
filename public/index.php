<?php
require_once '../vendor/autoload.php';
use \scriptzteam\TorrentIndex as TI;

?>

<?= TI\Header::create() ?>

<div class="container">
    <div class="page-header">
        <h1><?= TI\App::TI_NAME ?></h1>
    </div>
    <ul class="nav nav-pills">
        <li class="active"><a>Home</a></li>
        <li><a href="/search.php">Search</a></li>
    </ul>
    <br> <br>
    <?php
    $i = TI\Functions::scan(TI\App::TORRENT_DIR, 'torrent');
    if (count($i) == 0) {
        die('No torrents found. Add some to <code>./torrents/</code> for them to show up here.');
    }
    ?>
    <table class="table table-bordered">
        <tr>
            <th>Torrent name</th>
            <th>Torrent size</th>
            <th colspan="2">Download</th>
        </tr>
        <?php
        foreach ($i as $f) {
            TI\Functions::displayTorrent($f);
        }
        ?></table>
</div>

<?= TI\Footer::create() ?>
