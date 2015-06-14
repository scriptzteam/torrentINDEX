<?php
if (! defined('indirect')) {
    die('Direct access prohibited.');
}

/**
 * Scans a directory for specified filetypes and then returns the result as an array.
 *
 * @param string $dir
 *            The directory to scan.
 * @param string $filetype
 *            The file extension to look for.
 * @return array The scanned directory.
 * @since 2015-05-24
 */
function scan($dir, $filetype)
{
    return $i = glob($dir . "/*." . $filetype);
}

/**
 * Returns a file's size in a human-readable format, as opposed to it just being in bytes.
 *
 * @param unknown $size
 *            The number of bytes.
 * @param number $decimal
 *            Number of decimal places: default 2.
 * @return string The human filesize.
 * @since 2015-05-26
 */
function human_filesize($size, $decimal = 2)
{
    $sz = 'BKMGTP';
    $factor = floor((strlen($size) - 1) / 3);
    $type = @$sz[$factor];
    if ($type != "B") {
        $type = $type . "iB";
    }
    
    return sprintf("%.{$decimal}f ", $size / pow(1024, $factor)) . $type;
}

/**
 * Displays a torrent's basic info in table format.
 *
 * USED BY index.php AND search.php
 *
 * @param torrent $t
 *            The torrent to display.
 * @since 2015-05-25
 */
function displayTorrent($t)
{
    $torrent = new Torrent($t);
    
    echo ('<tr>');
    
    // torrent name:
    echo ('<td><a href="torrent.php?id=' . $torrent->hash_info() . '">' . $torrent->name() . '</a></td>');
    
    // torrent size:
    echo ('<td>' . human_filesize($torrent->size()) . '</td>');
    
    // .torrent:
    echo ('<td><a href="' . $t . '">.torrent</a></td>');
    
    // magnet link:
    echo ('<td>&nbsp;<a href="' . $torrent->magnet(true) . '"><i class="fa fa-magnet"></i></a></td>');
    
    echo ('</tr>');
}
