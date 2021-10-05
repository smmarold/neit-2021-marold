<?php
    //Changed task to use boolean for Complete. 
    $task = [
        'title' => 'Buy a Boat',
        'due' => 'End of Year',
        'assignee' => 'Stephen',
        'complete' => true
    ]

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task E</title>
</head>
<body>
        <h1>The Task!</h1>
        <ul>
            <li>
                <strong>Task Name: </strong> <?= $task['title'];?> 
            </li>
            <li>
                <strong>Due Date: </strong> <?= $task['due'];?> 
            </li> 
            <li>
                <strong>Who is Doing This?: </strong> <?= $task['assignee'];?> 
            </li> 
            <li>
                <strong>Status: </strong> 
                <?php 
                    if($task['complete']){
                        echo '&#9989';
                    }
                    else {
                        echo 'Incomplete';
                    }
                ?> 
            </li>             
        </ul>

</body>
</html>