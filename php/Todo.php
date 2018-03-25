<?php
class Todo {
  function __construct () {
    $this->dbFilePath = './../db.json';
    $this->dbFileContent = json_decode($this->readFile(), true);
  }

  function writeFile ($fileContent = '') {
    $fileContent = $fileContent ? $fileContent : json_encode($this->dbFileContent);
    if (file_put_contents($this->dbFilePath, $fileContent)) {
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
    $biggestKey = intval(max(array_keys($this->dbFileContent)));
    $newTaskId = $biggestKey ? ($biggestKey + 1) : 1;
    $this->dbFileContent[$newTaskId] = ['title' => $taskTitle, 'done' => 0];
    return $this->writeFile() ? "added: $taskTitle" : 'error';
  }

  function editTask ($taskId, $taskTitle) {
    if ($this->dbFileContent[$taskId]) {
      $this->dbFileContent[$taskId]['title'] = $taskTitle;
      return $this->writeFile() ? "edited: $taskId" : 'error';
    }
  }

  function markAsDone ($taskId) {
    if ($this->dbFileContent[$taskId]) {
      $this->dbFileContent[$taskId]['done'] = 1;
      return $this->writeFile() ? "marked as done: $taskId" : 'error';
    }
  }

  function markAsUndone ($taskId) {
    if ($this->dbFileContent[$taskId]) {
      $this->dbFileContent[$taskId]['done'] = 0;
      return $this->writeFile() ? "marked as undone: $taskId" : 'error';
    }
  }

  function removeTask ($taskId) {
    if ($this->dbFileContent[$taskId]) {
      unset($this->dbFileContent[$taskId]);
      return $this->writeFile() ? "removed: $taskId" : 'error';
    }
  }

  function listTasks () {
    $tasks = "ID\tDone\tTask\n====================";
    foreach ($this->dbFileContent as $id => $value) {
      $title = $value['title'];
      $done = $value['done'] ? '[x]' : '[ ]';
      $tasks .= "\n#$id\t$done\t$title";
    }
    return $tasks;
  }
}

$todo = new Todo;
