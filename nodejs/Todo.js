const fs = require('fs')

class Todo {
  constructor () {
    this.dbFilePath = './../db.json'
    this.dbFileContent = JSON.parse(this.readFile())
  }

  writeFile (fileContent) {
    fileContent = fileContent || JSON.stringify(this.dbFileContent)
    fs.writeFileSync(this.dbFilePath, fileContent, (err) => {
      if (err) throw err
    })
    return true
  }

  readFile () {
    if (fs.existsSync(this.dbFilePath)) {
      return fs.readFileSync(this.dbFilePath, 'utf8')
    } else {
      this.writeFile('{}')
      return '{}'
    }
  }

  addTask (taskTitle) {
    const lastKey = parseInt(Object.keys(this.dbFileContent).pop())
    const newTaskId = lastKey ? (lastKey + 1) : 1
    this.dbFileContent[newTaskId] = { title: taskTitle, done: 0 }
    return this.writeFile() ? `added: ${taskTitle}` : 'error'
  }

  editTask (taskId, taskTitle) {
    if (this.dbFileContent[taskId]) {
      this.dbFileContent[taskId].title = taskTitle
      return this.writeFile() ? `edited: ${taskId}` : 'error'
    }
  }

  markAsDone (taskId) {
    if (this.dbFileContent[taskId]) {
      this.dbFileContent[taskId].done = 1
      return this.writeFile() ? `marked as done: ${taskId}` : 'error'
    }
  }

  markAsUndone (taskId) {
    if (this.dbFileContent[taskId]) {
      this.dbFileContent[taskId].done = 0
      return this.writeFile() ? `marked as undone: ${taskId}` : 'error'
    }
  }

  removeTask (taskId) {
    if (this.dbFileContent[taskId]) {
      delete this.dbFileContent[taskId]
      return this.writeFile() ? `removed: ${taskId}` : 'error'
    }
  }

  listTasks () {
    let tasks = 'ID\tDone\tTask\n===================='
    Object.keys(this.dbFileContent).map((id) => {
      const title = this.dbFileContent[id].title
      const done = this.dbFileContent[id].done ? '[x]' : '[ ]'
      tasks += `\n#${id}\t${done}\t${title}`
    })
    return tasks
  }
}

module.exports = new Todo()
