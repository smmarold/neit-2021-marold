<?php

//The infamous Fizz Buzz function. I set up a result variable that only changes based on the ifs, so it returns the number if the answer is no. 
function fizzBuzz($num){
    $result = $num;
    if($num % 6 == 0){
        $result = 'fizz buzz';
    }
    else if($num % 3 == 0){
        $result = 'buzz';
    }
    else if($num % 2 == 0){
        $result = 'fizz';
    }

    return $result;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FizzBuzz</title>
</head>
<body>
    <h1>Fizz Buzz</h1>
    <ul>
        <!--Created a UL, and used a for loop from 1-100, calling fizzBuzz on each one, and printing the result to the screen.  -->
        <?php for($i = 1; $i <= 100; $i++){ ?>
        <li>
            <?php echo fizzBuzz($i); ?>
        </li>
        <?php } ?>
    </ul>
</body>
</html>