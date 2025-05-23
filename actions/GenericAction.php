<?php 
require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../controllers/WorkerController.php';
require_once __DIR__ . '/../controllers/GenericController.php';


$response = ['success' => false, 'message' => 'Requisição inválida.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type'])) {
    switch ($_POST['form_type']) {
        case 'signUpWorker':
            $controller = new WorkerController();
            $response = $controller->register($_POST);
            break;
        case 'addProject':
            $controller = new GenericController();
            $response = $controller->addProject($_POST['nameProject'], $_POST['timeProject']);
            break;
        case 'addPosition':
            $controller = new GenericController();
            $response = $controller->addPosition($_POST['positionName']);
            break;
        case 'deleteProject':
                $controller = new GenericController();
                $response = $controller->deleteProject($_POST['idProject']);
            break;
        case 'deletePosition':
                 $controller = new GenericController();
                 $response = $controller->deleteJobPosition($_POST['idJobPosition']);
            break;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'listProjects':
            $controller = new GenericController();
            $response = $controller->listProject();
            break;

        case 'listPositions':
            $controller = new GenericController();
            $response = $controller->listPosition();
            break;

            // Outros gets...
    }
}

header('Content-Type: application/json');
echo json_encode($response);