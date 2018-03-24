import sys

from Todo import todo

argv1 = sys.argv[1] if len(sys.argv) > 1 else ''
argv2 = sys.argv[2] if len(sys.argv) > 2 else ''
argv3 = sys.argv[3] if len(sys.argv) > 3 else ''

result = ''
if argv1 == '-a' or argv1 == '--add':
  result = todo.addTask(argv2)
elif argv1 == '-l' or argv1 == '--list':
  result = todo.listTasks()
elif argv1 == '-e' or argv1 == '--edit':
  result = todo.editTask(argv2, argv3)
elif argv1 == '-d' or argv1 == '--done':
  result = todo.markAsDone(argv2)
elif argv1 == '-u' or argv1 == '--undone':
  result = todo.markAsUndone(argv2)
elif argv1 == '-r' or argv1 == '--remove':
  result = todo.removeTask(argv2)
else:
  result = """
Available commands:

Add new task:
$ python app.py -a|--add "<taskTitle>"

List all tasks:
$ python app.py -l|--list

Edit task:
$ python app.py -e|--edit <taskId> "<taskTitle>"

Mark as done:
$ python app.py -d|--done <taskId>

Mark as undone:
$ python app.py -u|--undone <taskId>

Remove task:
$ python app.py -r|--remove <taskId>

This screen:
$ python app.py
  """

print result
