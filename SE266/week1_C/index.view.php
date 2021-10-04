<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SE266 PHP and Arrays</title>

</head>
<body>

    <ul>
        <?php 
            //Inside the html ul, run a foreach loop on our animal array, displaying as a li on the page. easy peasy. 
            foreach ($animals as $animal){
                echo "<li>$animal</li>";
            }

        ?>
    </ul>

</body>
</html>