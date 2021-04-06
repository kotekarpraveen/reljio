<?php

//*************************//
// This file includes all constants used in projects
//************************//



define("PHOTO_JSON_URL", "https://jsonplaceholder.typicode.com/photos");

define("ALBUM_JSON_URL", "https://jsonplaceholder.typicode.com/albums");

define("CODE_BASE_PATH", "http://" . $_SERVER['SERVER_NAME'] . "/album");




define("HOST", "localhost");
define("DBNAME", "album");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

//album logs related
define("MODULE_NAME", "album");
define("BASEPATH", "http://localhost/" . MODULE_NAME);
define("LOGS_PATH", BASEPATH . "/" . MODULE_NAME . "/logs/");


define("CURRENT_DATE", DATE('Y-m-d'));
define("CURRENT_TIME", DATE('H:i:s'));

//Common utility
define("DB_PAGE_LIMIT", 20);


define("PHOTO_PATH", BASEPATH . "ui/bootstrap/dist/img/");
