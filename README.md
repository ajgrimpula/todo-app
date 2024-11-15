## Overview

The To-Do List Application is a simple web-based task management tool that allows users to:

- Add new tasks
- Mark tasks as completed
- Delete tasks
- Set priorities for tasks
- View tasks with sorting functionality
- View total and completed task counts

This project uses PHP for the backend logic, SQLite for the database, and HTML/CSS for the frontend.

## Features

1. **Add Task**: Users can add new tasks with a specified priority _(High, Medium, Low)_.
2. **View Tasks**: Displays a list of tasks with columns for task name, priority, status _(Pending/Completed)_, and actions.
3. **Delete Task**: Users can delete tasks from the list.
4. **Complete Task**: Users can mark tasks as completed.
5. **Set Priority**: Users can assign a priority level to each task _(1 - Low, 2 - Medium, 3 - High)_.
6. **Sorting:**
- Users can sort tasks by:
    - Task Name _(alphabetically)_
    - Priority _(High, Medium, Low)_
    - Status _(Pending or Completed)_
- Click on column headers to sort by that column. Click again to toggle between ascending and descending order.
7. **Task Counters**: Displays the total number of tasks and the count of completed tasks.

## Project Structure

```
todo-app/
├── index.php          # Main entry point (Frontend + Backend Integration)
├── todo.php           # PHP logic for task operations (CRUD)
├── database.php       # Database connection setup
├── tasks.sql          # SQL script to initialize the database
├── style.css          # CSS file for styling the UI
└── tasks.db           # SQLite database file (created after first run)
└── README.md          # Documentation
```

## Installation and Setup
### Prerequisites
- PHP (version 7.4 or later)
- SQLite (version 3.x)

### Step-by-Step Setup Guide

#### Step 1: Clone or Download the Project
```
git clone https://github.com/ajgrimpula/todo-app.git
cd todo-app
```
#### Step 2: Create Database (if not already created)
Run the following command to initialize the database:
```
php database.php
```

#### Step 3: Start PHP Built-in Server
```
php -S localhost:8080
```

#### Step 4: Open in Browser
``` 
http://localhost:8080
```

## Usage Guide

1. **Add a Task:**
- Enter a task name in the input box.
- Select the task priority _(High, Medium, Low)_.
- Click _Add Task_.

2. **View and Manage Tasks:**
- The task list is displayed in a table format.
- The columns include Task Name, Priority, Status, and Actions.
- Click the _Complete_ link to mark a task as completed.
- Click the _Delete_ link to remove a task from the list.

3. **Sorting Tasks:**
- Click on the column headers _(Task Name, Priority, or Status)_ to sort the tasks by that column.
- Clicking the same column header again toggles between ascending and descending order.

4. **Counters:**
- The total number of tasks and completed tasks are displayed above the task list.

## Database Schema
The database is an SQLite database named tasks.db with a single table tasks. Below is the schema:

### Table: tasks
```
id	        | INTEGER	| Primary key, auto-incremented
name	    | TEXT	    | Task description
priority	| INTEGER	| Task priority (1 = Low, 2 = Medium, 3 = High)
completed	| BOOLEAN	| Task status (0 = Incomplete, 1 = Complete)
```

#### SQL Script (tasks.sql)
```
CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    priority INTEGER DEFAULT 1,
    completed BOOLEAN DEFAULT 0
);
```

## How to Reset the Database

1. Delete the existing tasks.db file.
```
rm tasks.db
```

2. Reinitialize the database:
```
php database.php
```