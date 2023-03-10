<?php

try {

    require_once("todo.controller.php");

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode('/', $uri);
    $requestType = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    $pathCount = count($path);

    $controller = new TodoController();

    switch ($requestType) {
        case 'GET':
            if ($path[$pathCount - 2] == 'todo' && isset($path[$pathCount - 1]) && strlen($path[$pathCount - 1])) {
                $id = $path[$pathCount - 1];
                $todo = $controller->load($id);
                if ($todo) {
                    http_response_code(200);
                    die(json_encode($todo));
                }
                http_response_code(404);
                die();
            } else {
                http_response_code(200);
                die(json_encode($controller->loadAll()));
            }
            break;
        case 'POST':

            $obj = json_decode($body);

            $todo = new Todo($obj->id, $obj->title, $obj->description, $obj->done);

            $res = $controller->create($todo);
            http_response_code(200);
            die();
            break;
        case 'PUT':
            $obj = json_decode($body);

            $todo = new Todo($obj->id, $obj->title, $obj->description, $obj->done);
            $res = $controller->update($todo->id, $todo);
            http_response_code(200);
            die();
            break;
        case 'DELETE':
            $obj = json_decode($body);

            $todo = new Todo($obj->id, $obj->title, $obj->description, $obj->done);
            $res = $controller->delete($obj->id);
            $controller->writeTodos();
            http_response_code(200);
            die();
            break;
        default:
            http_response_code(501);
            die();
            break;
    }
} catch (Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die();
}
