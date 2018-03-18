const fs = require('fs')

class Todo {
  constructor () {
    this.dbFilePath = './../db.json'
    this.dbFileContent = JSON.parse(this.readFile())
  }

  writeFile (fileContent) {
    fileContent = fileContent || this.dbFileContent
    fs.writeFileSync(this.dbFilePath, JSON.stringify(fileContent), (err) => {
      if (err) throw err
    })
    return true
  }

  readFile () {
    if (fs.existsSync(this.dbFilePath)) {
      return fs.readFileSync(this.dbFilePath, 'utf8')
    } else {
      this.writeFile({})
      return '{}'
    }
  }

  addTask (taskTitle) {
    const lastKey = parseInt(Object.keys(this.dbFileContent).pop()) || 0
    const newTaskId = lastKey + 1
    this.dbFileContent[newTaskId] = taskTitle
    return this.writeFile() ? 'added' : 'error'
  }

  updateTask (taskId, taskTitle) {
    if (this.dbFileContent[taskId]) {
      this.dbFileContent[taskId] = taskTitle
      return this.writeFile() ? 'updated' : 'error'
    }
  }

  deleteTask (taskId) {
    delete this.dbFileContent[taskId]
    return this.writeFile() ? 'deleted' : 'error'
  }

  listTasks () {
    let tasks = 'ID\tTask\n===================='
    Object.keys(this.dbFileContent).map((key) => {
      tasks += `\n${key}:\t${this.dbFileContent[key]}`
    })
    return tasks
  }
}

module.exports = new Todo()
