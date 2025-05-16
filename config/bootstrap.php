<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (!defined('BASE_URL')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST']; // domínio (ex: localhost ou seu domínio)
    $scriptName = dirname($_SERVER['SCRIPT_NAME']); // pasta do projeto (ex: /isatadmin)
    
    // Remove barra final, se houver, e adiciona barra no final da URL
    $baseUrl = rtrim($protocol . $host . $scriptName, '/') . '/';
    
    define('BASE_URL', $baseUrl);
}


$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
