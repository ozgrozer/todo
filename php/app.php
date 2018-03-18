<?php
include('./Todo.php');

$argv1 = $argv[1];
$argv2 = $argv[2];
$argv3 = $argv[3];

$result = '';
switch ($argv1) {
  case '-a':
  case '--add':
    $result = $todo->addTask($argv2);
    break;
  case '-l':
  case '--list':
    $result = $todo->listTasks();
    break;
  case '-u':
  case '--update':
    $result = $todo->updateTask($argv2, $argv3);
    break;
  case '-d':
  case '--delete':
    $result = $todo->deleteTask($argv2);
    break;
  default:
    $result = '
Available commands:

Add new task:
$ php app.php -a|--add "<taskTitle>"

List all tasks:
$ php app.php -l|--list

Update task:
$ php app.php -u|--update <taskId> "<taskTitle>"

Delete task:
$ php app.php -d|--delete <taskId>

Available commands:
$ php app.php
    ';
}

echo $result . "\n";
