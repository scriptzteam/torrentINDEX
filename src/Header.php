<?php

namespace scriptzteam\TorrentIndex;

/**
 * Class Header.
 */
class Header
{
    /**
     * @return string
     */
    public static function create()
    {
        return '<!DOCTYPE html>
<html>
<head>
<title>'.App::TI_NAME.'</title>
<link href="/assets/css/bootstrap.min.css" rel="stylesheet"/>
<link href="/assets/css/font-awesome.min.css" rel="stylesheet"/>
<script src="/assets/js/jquery-2.2.4.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
</head>
<body>';
    }
}
