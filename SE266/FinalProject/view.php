<?php 
    //Include model file for get/add functions (mainly for isPostRequest()) as well as our user and client models for displaying and filtering. 
    include('includes/functions.php');
    include('models/model_clients.php');
    include('models/model_users.php');
    include('includes/header.php');

    //initialize vars
    $busName = '';
    $conName = '';
    $website = '';
    $userID = '';
    //if there is a post request (which can only mean we pressed a delete icon), call deleteClient with the id of the row it was clicked in. 
    if(isset($_POST['submitBtn'])){
        $id = filter_input(INPUT_POST, 'clientId');
        deleteClient($id);
    }
    //if the search button was pressed, we grab the search fields and call search. Otherwise, get ALL Clients. 
    if(isset($_POST['search'])) {
        $busName = filter_input(INPUT_POST, 'busName');
        $conName = filter_input(INPUT_POST, 'conName');
        $website = filter_input(INPUT_POST, 'website');
        if($_SESSION['isAdmin'])  
            $userID = '';
        else
            $userID = $_SESSION['userID'];
        
        $clients = searchClients($busName, $conName, $website, $userID);
    } else {
        if($_SESSION['isAdmin']) //If the user is an admin, set the id to blank, and pass it. The getClients func filters on id, or returns all if '' is passed. 
            $userID = '';
        else
            $userID = $_SESSION['userID'];

        $clients = getClients($userID);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Viewer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        .red{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-lg-12 col-sm-10">
            <h1>Clients</h1>
            <!-- If the logged in user is an admin, we display the Add Client button. -->
            <?php if($_SESSION['isAdmin']){ ?>
                <a href="./editClient.php?action=Add">Add Client</a>
            <?php } ?>            
            <form method="post" action="view.php">
                <h4>Client Search:</h4>
                    <div>Business Name: <input type="text" name="busName" value="<?= $busName ?>">  Contact Name: <input type="text" name="conName" value="<?= $conName ?>">  Website: <input type="text" name="website" value="<?= $website ?>">

                    <input type="submit" name="search" value="Search" class="btn btn-primary"></div>
            </form>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Business Name</th>
                        <th>Contact Name</th>
                        <th>Contact Email</th>
                        <th>Contact Phone</th>
                        <th>Website</th>
                        <th>User Notes</th>
                    </tr>
                </thead>
                <!-- Here, we loop through our results from earlier, and create a row in the table for each record returned. -->
                <tbody>
                    <?php foreach ($clients as $client){?>
                        <tr>
                            <td><?= $client['businessName']; ?></td>
                            <td><?= $client['contactName']; ?></td>
                            <td><?= $client['contactEmail']; ?></td>
                            <td><?= $client['contactPhone']; ?></td>
                            <td><?= $client['websiteAddress']; ?></td>
                            <td><?= $client['userNotes']; ?></td>
                            <!-- Display only if logged in user is an Admin -->
                            <?php if($_SESSION['isAdmin']){ ?>
                            <td>
                                <form action="view.php" method="post">
                                    <input type="hidden" name="clientId" value="<?= $client['id']; ?>"/>
                                    <button class="btn glyphicon glyphicon-trash red" name="submitBtn" type="submit"></button>
                                </form>
                            </td>
                            <?php } ?>
                            <!-- Create an edit link in each row, with that row's ID being sent in the URL as a parameter. -->
                            <td><a href="editClient.php?action=Update&clientId=<?= $client['id']; ?>">Edit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if(count($clients) == 0) echo '<h3>No Results</h3>'; ?>
            <?php if($_SESSION['isAdmin']){ ?>
                <a href="./editClient.php?action=Add">Add Client</a>
            <?php } ?> 
        </div>
    </div>
</body>
</html>