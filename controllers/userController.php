<?php

function kegiatanController($params)
{
    include('./config/connection.php');

    section_start('content');
    ob_start();
    include('./views/user/kegiatanDetail.php');
    echo ob_get_clean();
    section_end();
}


function alumniController()
{
    include('./config/connection.php');

    section_start('content');
    ob_start();
    include('./views/user/alumni.php');
    echo ob_get_clean();
    section_end();
}
