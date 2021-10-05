<?php
    //Create our task. Associative Array (feels like an object with an arrow instead of a colon)
    $task = [
        'Title' => 'Buy a Boat',
        'Due' => 'End of Year',
        'Assignee' => 'Stephen',
        'Comeplete' => 'Not yet...'
    ]

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task D- Associative Arrays</title>
</head>
<body>
        <ul>
            <?php 
                //Loop through array, display Key and Value. Key is in a strong tag for boldness. 
                foreach ($task as $trait => $value){
                    echo "<li><strong>$trait</strong> : $value</li>";
                }
            ?>
        </ul>

</body>
</html>