<?php

namespace scriptzteam\TorrentIndex;

/**
 * Class Footer.
 */
class Footer
{
    /**
     * @return string
     */
    public static function create()
    {
        return '<br>
<br>
<br>
<br>
<div class="container" align="center">
    <p class="text-muted">
        '.App::TI_NAME.' '.App::VERSION.'
    </p>
</div>
</body>
</html>';
    }
}
