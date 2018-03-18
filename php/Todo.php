<?php
class Todo {
  function __construct () {
    $this->dbFilePath = './../db.json';
    $this->dbFileContent = json_decode($this->readFile(), true);
  }

  function writeFile ($fileContent = '') {
    $fileContent = $fileContent ? $fileContent : $this->dbFileContent;
    if (file_put_contents($this->dbFilePath, json_encode($fileContent))) {
      return true;
    } else {
      return false;
    }
  }

  function readFile () {
    if (file_exists($this->dbFilePath)) {
      return file_get_contents($this->dbFilePath);
    } else {
      $this->writeFile('{}');
      return '{}';
    }
  }

  function addTask ($taskTitle) {
    $lastKey = @intval(array_pop(array_keys($this->dbFileContent))) || 0;
    $newTaskId = $lastKey + 1;
    $this->dbFileContent[$newTaskId] = $taskTitle;
    return $this->writeFile() ? "added: $taskTitle" : 'error';
  }

  function updateTask ($taskId, $taskTitle) {
    if ($this->dbFileContent[$taskId]) {
      $this->dbFileContent[$taskId] = $taskTitle;
      return $this->writeFile() ? "updated: $taskId" : 'error';
    }
  }

  function deleteTask ($taskId) {
    unset($this->dbFileContent[$taskId]);
    return $this->writeFile() ? "deleted: $taskId" : 'error';
  }

  function listTasks () {
    $tasks = "ID\tTask\n====================";
    foreach ($this->dbFileContent as $key => $value) {
      $tasks .= "\n#$key\t$value";
    }
    return $tasks;
  }
}

$todo = new Todo;
