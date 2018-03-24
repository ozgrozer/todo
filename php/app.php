<?php
include('./Todo.php');

$argv1 = $argv[1];
$argv2 = $argv[2];
$argv3 = $argv[3];

$result = '';
if ($argv1 === '-a' || $argv1 === '--add') {
  $result = $todo->addTask($argv2);
} elseif ($argv1 === '-l' || $argv1 === '--list') {
  $result = $todo->listTasks();
} elseif ($argv1 === '-e' || $argv1 === '--edit') {
  $result = $todo->editTask($argv2, $argv3);
} elseif ($argv1 === '-d' || $argv1 === '--done') {
  $result = $todo->markAsDone($argv2);
} elseif ($argv1 === '-u' || $argv1 === '--undone') {
  $result = $todo->markAsUndone($argv2);
} elseif ($argv1 === '-r' || $argv1 === '--remove') {
  $result = $todo->removeTask($argv2);
} else {
  $result = '
Available commands:

Add new task:
$ php app.php -a|--add "<taskTitle>"

List all tasks:
$ php app.php -l|--list

Edit task:
$ php app.php -e|--edit <taskId> "<taskTitle>"

Mark as done:
$ php app.php -d|--done <taskId>

Mark as undone:
$ php app.php -u|--undone <taskId>

Remove task:
$ php app.php -r|--remove <taskId>

This screen:
$ php app.php
  ';
}

echo $result . "\n";
