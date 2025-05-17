<?php
$menuItems = [
    'novoatendimento'   => 'Novo atendimento',
    'novopaciente'      => 'Novo paciente',
    'listaratendimentos'=> 'Listar atendimentos',
    'listarpacientes'   => 'Listar pacientes',
    'editarpaciente'    => 'Editar paciente',
    'filtragem'         => 'Filtragem',
    'feedbacks'          => 'Feedbacks',
    'gerenciar'         => 'Gerenciar',
];

$currentUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$currentUri = preg_replace('#^isatadmin/?#', '', $currentUri); 

$menuItems = array_map(function($route) {
    return ltrim($route, '/');
}, $menuItems);

function renderMenu($items, $activeRoute) {
    echo '<div class="menu">';
    foreach ($items as $route => $label) {
        $class = ($route === $activeRoute) ? ' class="active"' : '';
        echo "<div class='opt'><a href='" . BASE_URL . $route . "'{$class}>$label</a></div>";

    }
    echo "<a href='" . BASE_URL . "'>VOLTAR LOGIN</a>";
    var_dump(BASE_URL . $route);
    echo '</div>';
}
