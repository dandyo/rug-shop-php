<?php
// Load Config
require_once '../app/config/config.php';
//Loading Libraries
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/image_upload.php';

spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
