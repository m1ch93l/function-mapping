# Function Mapping

This project is a simple PHP CRUD example designed for students to understand how actions are mapped to functions.

## What this project teaches

- How a form action connects to a PHP function
- How to create, read, update, and delete records in a database
- How to keep code simple and easy to understand
- How to use pure PHP without JavaScript frameworks

## Example mapping

```php
$actions = [
    'create' => 'createUser',
    'read'   => 'readUser',
    'update' => 'updateUser',
    'delete' => 'deleteUser',
];
```

When the user clicks a button or submits a form, the action value is checked and the matching function is called.

## Setup

1. Start Apache and MySQL in XAMPP, WAMP, or Laragon.
2. Import the database file named `function_mapping.sql`.
3. Put the project folder inside your web server folder, such as `htdocs`.
4. Open the app in your browser:

```text
http://localhost/function-mapping
```

## How to use

1. Add a student using the form on the home page.
2. See the list of students in the table.
3. Click Edit to update a student name.
4. Click Delete to remove a student.

## Notes

- This version uses pure PHP only.
- The logic is kept simple so beginners can understand how action-to-function mapping works.
