<?php
    //Time Zone
    date_default_timezone_set('America/Sao_Paulo');

    //Include Path
    define('INCLUDE_PATH', 'http://localhost:8080');
    define('BASE_DIR', __DIR__);
    define('UPLOADS_DIR', __DIR__ . '/../public/uploads/');

    //Data Base
    define('DATABASE',
    ['HOST'=> 'localhost',
    'DATABASE'=> '',
    'USER'=> '',
    'PASSWORD'=> '']);