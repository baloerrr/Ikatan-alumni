<?php

function homeController()
{
    include('./config/connection.php');

    section_start('content');
    ob_start();
    include('./views/home.php');
    echo ob_get_clean();
    section_end();
}
