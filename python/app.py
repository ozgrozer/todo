import sys

from Todo import todo

argv1 = sys.argv[1] if len(sys.argv) > 1 else ''
argv2 = sys.argv[2] if len(sys.argv) > 2 else ''
argv3 = sys.argv[3] if len(sys.argv) > 3 else ''

result = ''
if argv1 == '-a' or argv1 == '--add':
  result = todo.addTask('argv2')
elif argv1 == '-l' or argv1 == '--list':
  result = todo.listTasks()
elif argv1 == '-u' or argv1 == '--update':
  result = todo.updateTask(argv2, argv3)
elif argv1 == '-d' or argv1 == '--delete':
  result = todo.deleteTask(argv2)
else:
  result = """
Available commands:

Add new task:
$ python app.py -a|--add "<taskTitle>"

List all tasks:
$ python app.py -l|--list

Update task:
$ python app.py -u|--update <taskId> "<taskTitle>"

Delete task:
$ python app.py -d|--delete <taskId>

Available commands:
$ python app.py
  """

print result
