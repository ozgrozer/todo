const todo = require('./Todo.js')

const a1 = process.argv[2]
const a2 = process.argv[3]
const a3 = process.argv[4]

let result = ''
switch (a1) {
  case '-a':
  case '--add':
    result = todo.addTask(a2)
    break
  case '-l':
  case '--list':
    result = todo.listTasks()
    break
  case '-u':
  case '--update':
    result = todo.updateTask(a2, a3)
    break
  case '-d':
  case '--delete':
    result = todo.deleteTask(a2)
    break
  default:
    result = `
Available commands:

Add new task:
$ node app.js -a|--add "<taskTitle>"

List all tasks:
$ node app.js -l|--list

Update task:
$ node app.js -u|--update <taskId> "<taskTitle>"

Delete task:
$ node app.js -d|--delete <taskId>

Available commands:
$ node app.js
    `
}

console.log(result)
