const todo = require('./Todo.js')

const argv1 = process.argv[2]
const argv2 = process.argv[3]
const argv3 = process.argv[4]

let result = ''
if (argv1 === '-a' || argv1 === '--add') {
  result = todo.addTask(argv2)
} else if (argv1 === '-l' || argv1 === '--list') {
  result = todo.listTasks()
} else if (argv1 === '-e' || argv1 === '--edit') {
  result = todo.editTask(argv2, argv3)
} else if (argv1 === '-d' || argv1 === '--done') {
  result = todo.markAsDone(argv2)
} else if (argv1 === '-u' || argv1 === '--undone') {
  result = todo.markAsUndone(argv2)
} else if (argv1 === '-r' || argv1 === '--remove') {
  result = todo.removeTask(argv2)
} else {
  result = `
Available commands:

Add new task:
$ node app.js -a|--add "<taskTitle>"

List all tasks:
$ node app.js -l|--list

Edit task:
$ node app.js -e|--edit <taskId> "<taskTitle>"

Mark as done:
$ node app.js -d|--done <taskId>

Mark as undone:
$ node app.js -u|--undone <taskId>

Remove task:
$ node app.js -r|--remove <taskId>

This screen:
$ node app.js
  `
}

console.log(result)
