<?php 
    //Page for adding and editing Users. Page accessed from viewUsers.php, only accessible by admins. 
    include('includes/functions.php');
    include('models/model_clients.php');
    include('models/model_users.php');
    include('includes/header.php');

    //initialize variables that need initializing. 
    //If not initialized every page load, these (except error) will throw errors if left blank and a blank form is submitted.
    $error = "";
    $firstName = "";
    $lastName = "";
    $email = "";
    $department = "";
    $isAdmin = "";
    $username = "";
    $password = "";
    //Figure out if we are updating or adding a User, and what our action is.  
    if(isset($_GET['action'])) {
        // If the action is GET, we passed params through the URL, meaning we are updating. We grab the action and id passed and store them in Vars.
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'userId');
        //If the action is Update, call getOneUser using the Id
        if($action == "Update"){
            $user = getOneUser($id);
            $firstName = $user['userFirstName'];
            $lastName = $user['userLastName'];
            $email = $user['userEmail'];
            $department = $user['department'];
            $isAdmin = $user['isAdmin'];
            $username = $user['username'];
        } else { //If not, the fields will be blank.
            $firstName = "";
            $lastName = "";
            $email = "";
            $department = "";
            $isAdmin = "";
            $username = "";
            $password = "";
        } 
    } elseif (isset($_POST['action'])){ 
        //If the action is a post (a button was clicked), we grab all the field values and store them in vars.
        $action = filter_input(INPUT_POST, 'action');
        $id = filter_input(INPUT_POST, 'userId');
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $email = filter_input(INPUT_POST, 'email');
        $department = filter_input(INPUT_POST, 'department');
        $isAdmin = filter_input(INPUT_POST, 'admin');
        $username = filter_input(INPUT_POST, 'username');
        if($action == "Add") //If the action was an add, we also grab the password to hash and store. PW field is hidden when updating. 
            $password = filter_input(INPUT_POST, 'password');

        
        //If any of the vlaues are blank or invalid, we add an error message to our Var, and display that in Red at the beginning of the form. 
        if($firstName == "")
            $error .= "<p>First Name is Required.</p>";
        if($lastName == "")
            $error .= "<p>Last Name is Required.</p>";
        if($email == "")
            $error .= "<p>Email is Required.</p>";
        if($username == '')
            $error .= "<p>Username is Required.</p>";
        if($action == "Add" && $password == "")
            $error .= "<p>Password is Required.</p>";
    }

    //Add or Update our Users accordingly. 
    if(isPostRequest() && $action == "Add" && $error == "") {
        $results = addUser($firstName, $lastName, $email, $department, $isAdmin, $username, $password);
        echo $results;
        header('Location: viewUsers.php');
    } elseif(isPostRequest() && $action == "Update" && $error == ""){
        $results = editUser($id, $firstName, $lastName, $email, $department, $isAdmin, $username);
        echo $results;
        header('Location: viewUsers.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Edit Users</title>
    <style>
        .fieldLabel{
            font-weight: bold;                                                                                 
        }
        .wrapper {
                display: grid;
                grid-template-columns: 180px 300px;
            }
        .wrapper div{
            padding: 5px;
        }
        p {
            color: red;
        }
        .fullPage{
            margin-left: 40%;
        }
    </style>
</head>
<body>
    <div class="fullPage">
    <h1>Add/Edit User</h1>
    <?= $error;?> <!-- If our error Var contains anything, display those errors on the page.  -->
    <!--Begin Form -->
    <form action="editUser.php" method="post">
        <div class="wrapper">
            <!-- Hidden input fields for getting and storing the actiona and ID values. -->
            <div><input type="hidden" name="action" value="<?= $action; ?>"/></div>
            <div><input type="hidden" name="userId" value="<?= $id; ?>"/></div>
            

            <div><label class="fieldLabel">First Name: </label></div>
            <div><input type="text" name="firstName" value="<?= $firstName; ?>"/></div>
            <div><label class="fieldLabel">Last Name: </label></div>
            <div><input type="text" name="lastName" value="<?= $lastName; ?>"/></div>
            <div><label class="fieldLabel">Email: </label></div>
            <div><input type="text" name="email" value="<?= $email; ?>"/></div>

            <div><label class="fieldLabel">Department:</label></div>
            <div><select name="department" id="department" >
                <option value="marketing">Marketing</option>
                <option value="video">Video Production</option>
                <option value="development">Web/App Development</option>
                <option value="sales">Sales</option>
                <option value="socialMedia">Social Media Management</option>    
            </select></div>

            <div><label class="fieldLabel">Administrator:</label></div>
            <div><select name="admin" id="admin" >
                <option value="0">No</option>
                <option value="1">Yes</option>   
            </select></div>

            <div><label class="fieldLabel">Username: </label></div>
            <div><input type="text" name="username" value="<?= $username; ?>"/></div>
            <?php if($action == 'Add'){?>
                <div><label class="fieldLabel">Password: </label></div>
                <div><input type="password" name="password" value="<?= $password; ?>"/></div>
            <?php } ?>

            <div class="button"><button type="submit" name="submitBtn"><?= $action; ?> User</button></div>
            <br />
            <br />
        </div>
    </form>
    </br>
    </br>
    </br>
    <a href="./viewUsers.php">Return to View Users</a>
    </div>
</body>
</html>