<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'config.php';
require_once 'employee.php';
require_once 'middleware.php';

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';
$token = str_replace('Bearer ', '', $authHeader);

if (!validateJWT($token, $jwt_secret)) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$employeeObj = new Employee($conn);
$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['PATH_INFO'] ?? '';
header('Content-Type: application/json');

switch ($method) {
    case 'GET':
        if ($endpoint === '/employees') {
            echo json_encode($employeeObj->getAllEmployees());
        } elseif (preg_match('/^\/employees\/(\d+)$/', $endpoint, $matches)) {
            echo json_encode($employeeObj->getEmployeeById($matches[1]));
        }
        break;
    case 'POST':
        if ($endpoint === '/employees') {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode(['success' => $employeeObj->addEmployee($data)]);
        }
        break;
    case 'PUT':
        if (preg_match('/^\/employees\/(\d+)$/', $endpoint, $matches)) {
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode(['success' => $employeeObj->updateEmployee($matches[1], $data)]);
        }
        break;
    case 'DELETE':
        if (preg_match('/^\/employees\/(\d+)$/', $endpoint, $matches)) {
            echo json_encode(['success' => $employeeObj->deleteEmployee($matches[1])]);
        }
        break;
}

?>