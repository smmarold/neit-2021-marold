<?php 
    //Added this page from proposal, as I realized there was no way to select a user to edit for the Admins. 
    //Include model file for get/add functions (mainly for isPostRequest()) as well as our user and client models for displaying and filtering. 
    include('includes/functions.php');
    include('models/model_clients.php');
    include('models/model_users.php');
    include('includes/header.php');

    //if there is a post request (which can only mean we pressed a delete icon), call deleteClient with the id of the row it was clicked in. 
    if(isset($_POST['submitBtn'])){
        $id = filter_input(INPUT_POST, 'userId');
        deleteUser($id);
    }

    $users = getUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
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
        <div class="col-sm-offset-2 col-sm-10">
            <h1>Users</h1>
            <a href="./editUser.php?action=Add">Add New User</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <!-- Here, we loop through our results from earlier, and create a row in the table for each record returned. -->
                <tbody>
                    <?php foreach ($users as $user){?>
                        <tr>
                            <td><?= $user['userFirstName']; ?></td>
                            <td><?= $user['userLastName']; ?></td>
                            <td><?= $user['userEmail']; ?></td>
                            <td><?= $user['department']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td>
                                <form action="viewUsers.php" method="post">
                                    <input type="hidden" name="userId" value="<?= $user['id']; ?>"/>
                                    <button class="btn glyphicon glyphicon-trash red" name="submitBtn" type="submit"></button>
                                </form>
                            </td>
                            <!-- Create an edit link in each row, with that row's ID being sent in the URL as a parameter. -->
                            <td><a href="editUser.php?action=Update&userId=<?= $user['id']; ?>">Edit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="./editUser.php?action=Add">Add New User</a>
        </div>
    </div>
</body>
</html>