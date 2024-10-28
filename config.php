<?php
require_once __DIR__ . '/envLoader.php';
loadEnv(__DIR__.'/.env');

define('BASEURL', getenv('BASEURL'));
define('DIGITAL_DIARY_FILE', getenv('DIGITAL_DIARY_PATH').'/'.getenv('DIGITAL_DIARY_FILENAME'));
define('DELIMITER', '[next_page]');
