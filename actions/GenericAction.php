<?php 
require_once __DIR__ . '/../config/bootstrap.php';
require_once __DIR__ . '/../controllers/WorkerController.php';
require_once __DIR__ . '/../controllers/GenericProjectController.php';
require_once __DIR__ . '/../controllers/GenericAdminController.php';


$response = ['success' => false, 'message' => 'Requisição inválida.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type'])) {
    switch ($_POST['form_type']) {
        case 'signUpWorker':
            $controller = new WorkerController();
            $response = $controller->register($_POST);
            break;
        case 'addProject':
            $controller = new GenericProjectController();
            $response = $controller->addProject($_POST['nameProject'], $_POST['timeProject']);
            break;
        case 'addPosition':
            $controller = new GenericProjectController();
            $response = $controller->addPosition($_POST['positionName']);
            break;
        case 'deleteProject':
                $controller = new GenericProjectController();
                $response = $controller->deleteProject($_POST['idProject']);
            break;
        case 'deletePosition':
                 $controller = new GenericProjectController();
                 $response = $controller->deleteJobPosition($_POST['idJobPosition']);
            break;
        case 'addBenefit':
                 $controller = new GenericAdminController();
                 $response = $controller->addBenefit($_POST['benefit'], $_POST['typeBenefit'], $_POST['qtdBenefit'], $_POST['description']);
        break;
        case 'deleteBenefit':
                $controller = new GenericAdminController();
                $response = $controller->deleteBenefit($_POST['idBenefit']);
        break;
        case 'addExpense':
                $controller = new GenericAdminController();
                $response = $controller->addExpense($_POST['expense']);
        break;
        case 'deleteExpense':
                $controller = new GenericAdminController();
                $response = $controller->deleteExpense($_POST['idExpense']);
        break;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'listProjects':
            $controller = new GenericProjectController();
            $response = $controller->listProject();
            break;

        case 'listPositions':
            $controller = new GenericProjectController();
            $response = $controller->listPosition();
            break;
        case 'listBenefit':
            $controller = new GenericAdminController();
            $response = $controller->listBenefit();
        break;
        case 'listExpense':
            $controller = new GenericAdminController();
            $response = $controller->listExpense();
        break;
        // Outros gets...
    }
}

header('Content-Type: application/json');
echo json_encode($response);