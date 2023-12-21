<?php
// Вывод ошибок
ini_set('display_errors', 1);
ini_set('memory_limit', '512M');
error_reporting(E_ERROR);

// Подключаем
define('MODX_API_MODE', true);
require '../index.php';

// Включаем обработку ошибок
$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_FATAL);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');