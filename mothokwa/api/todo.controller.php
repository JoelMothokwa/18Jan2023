<?php

require_once("todo.class.php");

class TodoController {

    private const PATH = __DIR__ . "/todo.json";

    private array $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            foreach ($dataArray as $data) {
                if (isset($data->id) && isset($data->title))
                    $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done);
            }
        }
    }

    public function loadAll(): array {
        return $this->todos;
    }

    public function load(string $id): Todo|bool {
        foreach ($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $todo): bool {
        $this->todos[] = $todo;
        if ($this->writeTodos()) {            
            return true;
        } else {
            return false;
        }
    }

    public function update(string $id, Todo $todo): bool {
        $this->delete($id);
        $this->create($todo);   //update todo.json file
        
        return true;
    }

    public function delete(string $id): bool {
        foreach ($this->todos as $index=>$todo) {
            if ($todo->id == $id) {
                unset($this->todos[$index]);
                return true;
            }
        }
        return true;
    }

    public function writeTodos(): bool {
        try {
            $todos = json_encode($this->todos);
            $todoFile = fopen(self::PATH, 'a+');
            ftruncate($todoFile, 0);
            fwrite($todoFile, $todos);
            fclose($todoFile);
        } catch (Exception $ex) {
            error_log($ex->getMessage());
            //http_response_code(501);
            die();
        }

        return true;
    }

}
