<?php
require_once __DIR__ . '/bootstrap.php'; // se estiver usando .env, autoload etc.

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/isatadmin/', '', $uri);
$uri = trim($uri, '/');

switch ($uri) {
    case '':
    case 'home':
        require 'home.php';
        break;

    case 'editarpaciente':
    case 'novopaciente':
    case 'novoatendimento':
    case 'listarpacientes':
    case 'feedback':
    case 'filtragem':
    case 'gerenciar':
    case 'listaratendimentos':
        require "pages/{$uri}.html";
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";
}