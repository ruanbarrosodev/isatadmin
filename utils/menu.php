<?php
$menuItems = [
    'novoatendimento'   => 'Novo atendimento',
   /*  'novopaciente'      => 'Novo paciente', */
    'listaratendimentos'=> 'Listar atendimentos',
    'listarpacientes'   => 'Listar pacientes',
    'editarpaciente'    => 'Editar paciente',
    'filtragem'         => 'Filtragem',
    'feedbacks'         => 'Feedbacks',
    'gerenciar'         => 'Gerenciar',
];

$currentUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$currentUri = preg_replace('#^isatadmin/?#', '', $currentUri);

$menuItems = array_map(function($route) {
    return ltrim($route, '/');
}, $menuItems);

function renderMenu($items, $activeRoute) {
    $jobPosition = $_SESSION['JobPosition'] ?? '';
    echo '<div class="menu">';
    foreach ($items as $route => $label) {
        // ✅ Se for 'gerenciar' ou 'feedbacks', só mostra pra diretora ou desenvolvedor
        if (in_array($route, ['gerenciar', 'feedbacks'])) {
            if (!in_array($jobPosition, ['Diretora', 'Desenvolvedor'])) {
                continue; // Pula esse item
            }
        }

        $class = ($route === $activeRoute) ? ' class="active"' : '';
        echo "<div class='opt'><a href='" . BASE_URL . $route . "'{$class}>$label</a></div>";
    }
    echo '</div>';
}
?>
