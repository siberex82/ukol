<?php
/**
 * Created by PhpStorm.
 * User: $WebDev
 * Date: 14.05.2020
 * Time: 3:10
 */
require_once __DIR__."/config/path.php";
require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/bin/main/container.php";

bin\main\container::env();


require_once __DIR__."/config/sql.php";
require_once __DIR__."/config/config.php";

sql::connect();