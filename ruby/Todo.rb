require 'json'

class Todo
  def initialize
    @dbFilePath = './../db.json'
    @dbFileContent = JSON.parse(readFile())
  end

  def writeFile (fileContent = '')
    return 'writeFile'
  end

  def readFile
    if File.exist?(@dbFilePath)
      return File.read(@dbFilePath)
    else
      writeFile('{}')
      return '{}'
    end
  end

  def addTask (taskTitle)
    biggestKey = @dbFileContent.map { |quote| quote[0].to_i }.max
    newTaskId = biggestKey ? (biggestKey + 1) : 1
    @dbFileContent[newTaskId] = { title: taskTitle, done: 0 }
    return writeFile() ? 'added: ' + taskTitle : 'error'
  end

  def editTask (taskId, taskTitle)
    return 'editTask'
  end

  def markAsDone (taskId)
    return 'markAsDone'
  end

  def markAsUndone (taskId)
    return 'markAsUndone'
  end

  def removeTask (taskId)
    return 'removeTask'
  end

  def listTasks
    tasks = "ID\tDone\tTask\n===================="
    @dbFileContent.each do |key|
      @id = key[0]
      @title = key[1]['title']
      @done = key[1]['done'] === 1 ? '[x]' : '[ ]'
      tasks += "\n##@id\t#@done\t#@title"
    end
    return tasks
  end
end
