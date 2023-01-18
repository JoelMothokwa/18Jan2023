<?php

class Todo {

    public function __construct(public string $id,
            public string $title,
            public string $description = '',
            public bool $done = false) {
        
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->done = $done;
    }

    public function setID(string $id = null) {
        $this->id = $id;
    }

    public function getID(): string {
        return $this->id;
    }

    public function setTitle(string $title = null) {
        $this->title = $title;
    }

    public function getTitle(): string {
        $this->title;
    }

    public function setDescription(string $description = '') {
        $this->description = $description;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDone(bool $done = false) {
        $this->done = $done;
    }

    public function getDone(): bool {
        return $this->done;
    }

}
