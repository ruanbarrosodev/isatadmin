<?php
/*
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
*/
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = '/isatadmin/';
$uri = str_starts_with($uri, $base) ? substr($uri, strlen($base)) : $uri;

$uri = trim($uri, '/');

switch ($uri) {
    case '':
        require 'login.html'; 
        break;
    case 'home':
        require './home.php';
        break;
    case 'novopaciente':
        require 'pages/novopaciente.php';
        break;
    case 'editarpaciente':
        require 'pages/editarpaciente.php';
        break;
    case 'novoatendimento':
        require 'pages/novoatendimento.php';
        break;
    case 'listarpacientes':
        require 'pages/listarpacientes.php';
        break;
    case 'feedbacks':
        require 'pages/feedbacks.php';
        break;
    case 'filtragem':
        require 'pages/filtragem.php';
        break;
    case 'gerenciar':
        require 'pages/gerenciar.php';
        break;
    case 'listaratendimentos':
        require 'pages/listaratendimentos.php';
        break;
    default:
        http_response_code(404);
        echo "Página não encontrada";
        break;
}
