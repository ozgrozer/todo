require_relative 'Todo'

todo = Todo.new()

argv1 = ARGV[0]
argv2 = ARGV[1]
argv3 = ARGV[2]

result = ''
if argv1 === '-a' or argv1 === '--add'
  result = todo.addTask(argv2)
elsif argv1 === '-l' or argv1 === '--list'
  result = todo.listTasks()
elsif argv1 === '-e' or argv1 === '--edit'
  result = todo.editTask(argv2, argv3)
elsif argv1 === '-d' or argv1 === '--done'
  result = todo.markAsDone(argv2)
elsif argv1 === '-u' or argv1 === '--undone'
  result = todo.markAsUndone(argv2)
elsif argv1 === '-r' or argv1 === '--remove'
  result = todo.removeTask(argv2)
else
  result = '
Available commands:

Add new task:
$ ruby app.rb -a|--add "<taskTitle>"

List all tasks:
$ ruby app.rb -l|--list

Edit task:
$ ruby app.rb -e|--edit <taskId> "<taskTitle>"

Mark as done:
$ ruby app.rb -d|--done <taskId>

Mark as undone:
$ ruby app.rb -u|--undone <taskId>

Remove task:
$ ruby app.rb -r|--remove <taskId>

This screen:
$ ruby app.rb'
end

puts result
