<?php

namespace scriptzteam\TorrentIndex;

/**
 * Class Functions.
 */
class Functions
{
    /**
     * Scans a directory for specified file types and then returns the result as an array.
     *
     * @param string $dir       - The directory to scan.
     * @param string $file_type - The file extension to look for.
     *
     * @return array - The scanned directory.
     */
    public static function scan($dir, $file_type)
    {
        return $i = glob($dir.'/*.'.$file_type);
    }

    /**
     * Returns a file's size in a human-readable format, as opposed to it just being in bytes.
     *
     * @param int $size    - The number of bytes.
     * @param int $decimal - Number of decimal places: default 2.
     *
     * @return string - The human file size.
     */
    public static function human_filesize($size, $decimal = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($size) - 1) / 3);
        $type = @$sz[$factor];
        if ($type != 'B') {
            $type = $type.'iB';
        }

        return sprintf("%.{$decimal}f ", $size / pow(1024, $factor)).$type;
    }

    /**
     * Displays a torrent's basic info in table format.
     *
     * USED BY index.php AND search.php
     *
     * @param torrent $t The torrent to display.
     */
    public static function displayTorrent($t)
    {
        $torrent = new Torrent($t);

        echo '<tr>';

        // torrent name:
        echo '<td><a href="/torrent.php?id='.$torrent->hash_info().'">'.$torrent->name().'</a></td>';

        // torrent size:
        echo '<td>'.self::human_filesize($torrent->size()).'</td>';

        // .torrent:
        echo '<td><a href="/'.$t.'"><span class="fa fa-download fa-fw"></span></a></td>';

        // magnet link:
        echo '<td><a href="'.$torrent->magnet(true).'"><span class="fa fa-magnet fa-fw fa-rotate-180"></span></a></td>';

        echo '</tr>';
    }
}
