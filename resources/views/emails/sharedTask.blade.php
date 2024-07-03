<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shared Task</title>
</head>
<body>
    <h1>Shared Task</h1>
    <p>This is a shared task</p>
    <p>Task: {{ $task->title }}</p>
    <p>Task Description: {{ $task->description }}</p>
    <p>User shared: {{ $user->name }} | {{ $user->email }}</p>
</body>
</html>
