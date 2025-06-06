<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (!defined('BASE_URL')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST']; // domínio (ex: localhost ou seu domínio)
    $scriptName = dirname($_SERVER['SCRIPT_NAME']); // pasta do projeto (ex: /isatadmin)
    
    // Monta a URL base
    $baseUrl = rtrim($protocol . $host . $scriptName, '/') . '/';
    
    // Remove barras invertidas indesejadas que possam aparecer
    $baseUrl = str_replace('\\', '', $baseUrl);
    
    define('BASE_URL', $baseUrl);
}
ini_set('log_errors', 1);
ini_set('display_errors', 1);
ini_set('error_log', __DIR__ . '/php_error.log');


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
