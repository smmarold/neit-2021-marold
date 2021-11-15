<?php 

include('models/model_schools.php');
include('includes/functions.php');

//Initialize our vars.
$schoolName = '';
$city = '';
$state = '';
$schools = array();
//if a search was performed, call the search function from models, 
if(isPostRequest()){
    $schoolName = filter_input(INPUT_POST, 'schoolName');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $schools = getSchools($schoolName, $city, $state);
}

include('includes/header.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Schools</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <h1>Search Schools</h1>
    <form method="post" action="search.php">
        <div class="rowContainer">
            <div class="col1">School Name:</div>
            <div class="col2"><input type="text" name="schoolName" value="<?= $schoolName ?>"></div>
        </div>
        <div class="rowContainer">
            <div class="col1">City:</div>
            <div class="col2"><input type="text" name="city" value="<?= $city ?>"></div>
        </div>
        <div class="rowContainer">
            <div class="col1">State: (abbr)</div>
            <div class="col2"><input type="text" name="state" value="<?= $state ?>"></div>
        </div>
        <div class="rowContainer">
            <div class="col1">&nbsp;</div>
            <div class="col2"><input type="submit" name="search" value="Search" class="btn btn-warning"></div>
        </div>
    </form>

    <?php if ($schools){ ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>School Name</th>
                    <th>City</th>
                    <th>State</th>
                </tr>
            </thead>
            <!-- Here, we loop through our results from earlier, and create a row in the table for each record returned. -->
            <tbody>
                <?php foreach ($schools as $school){?>
                    <tr>
                        <td><?= $school['schoolName']; ?></td>
                        <td><?= $school['schoolCity']; ?></td>
                        <td><?= $school['schoolState']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } 
        include('includes/footer.php');
    ?>

</body>
</html>