<?php
require_once '../vendor/autoload.php';
use scriptzteam\TorrentIndex as TI;

if (!isset($_GET['id'])) {
    die('A torrent ID must be specified.');
}

$id = $_GET['id'];

$torrent = $found = false;
$file = '';

foreach (TI\Functions::scan('./torrents', 'torrent') as $f) {
    $file = $f;
    $torrent = new TI\Torrent($f);
    if ($torrent->hash_info() == $id) {
        $found = true;
        break;
    }
}

if (!$found || !$torrent) {
    die('That torrent ID was invalid. No file was found in <code>./torrents/</code> - try again!');
}

$announce = $torrent->announce();
$comment = $torrent->comment();
$content = $torrent->content();
$magnet_html = $torrent->magnet(true);
$name = $torrent->name();
$size = $torrent->size();
$hash = $torrent->hash_info();
?>

<?= TI\Header::create() ?>

    <div class="container">
        <div class="page-header">
            <h1><?= TI\App::TI_NAME ?></h1>
        </div>
        <ul class="nav nav-pills">
            <li><a href="/">Home</a></li>
            <li><a href="/search.php">Search</a></li>
            <li class="active"><a>Torrent - <?= $name ?></a></li>
        </ul>
        <h2><?= $name ?></h2>
        <div class="panel-group">
            <a class="btn btn-default" href="<?= $file ?>">
                <i class="fa fa-download"></i> Download .torrent
            </a>
            <a class="btn btn-default" href="<?= $magnet_html ?>">
                <i class="fa fa-magnet"></i> Magnet Link
            </a>
        </div>
        <table class="table table-bordered">
            <tr>
                <td>Torrent name:</td>
                <td><?= $name ?></td>
            </tr>
            <tr>
                <td>Torrent Hash:</td>
                <td><?= $hash ?></td>
            </tr>
            <tr>
                <td>Announce URL:</td>
                <td><?= $announce ?></td>
            </tr>
            <tr>
                <td>Comment:</td>
                <td><?= $comment ?></td>
            </tr>
            <tr>
                <td>Size:</td>
                <td><?= TI\Functions::human_filesize($size) ?></td>
            </tr>
            <tr>
                <td>Files:</td>
                <td>
                    <a class="btn btn-default btn-xs" role="button" data-toggle="collapse" href="#spoiler"
                       aria-expanded="false" aria-controls="spoiler">
                        Show/hide files
                    </a>
                    <div id="spoiler" class="collapse">
                        <?php
                        foreach ($content as $f => $value) {
                            echo $f.' ['.TI\Functions::human_filesize($value).']'.'<br>';
                        }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

<?= TI\Footer::create() ?>