import os
import json

class Todo:
  def __init__ (self):
    self.dbFilePath = './../db.json'
    self.dbFileContent = json.loads(self.readFile())

  def writeFile (self, fileContent = None):
    fileContent = fileContent if fileContent else json.dumps(self.dbFileContent)
    file = open(self.dbFilePath, 'w')
    file.write(fileContent)
    file.close()
    return True

  def readFile (self):
    if (os.path.exists(self.dbFilePath)):
      file = open(self.dbFilePath, 'r')
      return file.read()
    else:
      self.writeFile('{}')
      return '{}'

  def addTask (self, taskTitle):
    lastKey = int(sorted(self.dbFileContent.keys())[-1]) if self.dbFileContent else 0
    newTaskId = (lastKey + 1) if lastKey else 1
    self.dbFileContent[newTaskId] = { 'title': taskTitle, 'done': 0 }
    return 'added: {0}'.format(taskTitle) if self.writeFile() else 'error'

  def editTask (self, taskId, taskTitle):
    if self.dbFileContent[taskId]:
      self.dbFileContent[taskId]['title'] = taskTitle
      return 'edited: {0}'.format(taskTitle) if self.writeFile() else 'error'

  def markAsDone (self, taskId):
    if self.dbFileContent[taskId]:
      self.dbFileContent[taskId]['done'] = 1
      return 'marked as done: {0}'.format(taskId) if self.writeFile() else 'error'

  def markAsUndone (self, taskId):
    if self.dbFileContent[taskId]:
      self.dbFileContent[taskId]['done'] = 0
      return 'marked as undone: {0}'.format(taskId) if self.writeFile() else 'error'

  def removeTask (self, taskId):
    if self.dbFileContent[taskId]:
      del self.dbFileContent[taskId]
      return 'removed: {0}'.format(taskId) if self.writeFile() else 'error'

  def listTasks (self):
    tasks = 'ID\tDone\tTask\n===================='
    for id in self.dbFileContent:
      title = self.dbFileContent[id]['title']
      done = '[x]' if self.dbFileContent[id]['done'] else '[ ]'
      tasks += '\n#{0}\t{1}\t{2}'.format(id, done, title)
    return tasks

todo = Todo()
