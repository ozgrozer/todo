class Todo:
  def __init__ (self):
    self.dbFilePath = './../db.json'
    self.dbFileContent = ''

  def writeFile (self, fileContent):
    return 'writeFile'

  def readFile (self):
    return 'readFile'

  def addTask (self, taskTitle):
    return 'addTask'

  def updateTask (self, taskId, taskTitle):
    return 'updateTask'

  def deleteTask (self, taskId):
    return 'deleteTask'

  def listTasks (self):
    return 'listTasks'

todo = Todo()
