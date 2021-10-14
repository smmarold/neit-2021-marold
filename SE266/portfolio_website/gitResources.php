<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Resources</title>
    <style>
        .navbar{
            background-color:#404040;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.5em;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            color: white;        }
        .navbar a {
            padding: 15px;
            color: white;
        }

    </style>
</head>
<body>
    <div class = 'navbar'>
        <a href="./index.php">Home</a>
        <a href="https://github.com/smmarold/neit-2021-smarold/tree/main/SE266" target="_blank">GitHub Repo</a>
        <a href="./phpResources.php">PHP Resources</a>
        <a href="./gitResources.php">GitHub Resources</a>
        <a href="./hobbies.php">What I Do</a>
    </div>
        <!-- Links to my Git Resourses. Documentation, a tutorial, and a video--> 
    <h1>GIT Resources</h1>
    <ul>
        <li><a href="https://git-scm.com/docs" target="_blank">Git Reference Manual</a></li>
        <li><a href="https://www.w3schools.com/git/" target="_blank">w3schools Git</a></li>
        <li><a href="https://www.youtube.com/watch?v=8JJ101D3knE" target="_blank">Git Tutorial Video</a></li>
    </ul>
    <?php include __DIR__ . './footer.php'; ?>