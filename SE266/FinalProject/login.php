<?php
    include('includes/functions.php');
    include('models/model_clients.php');
    include('models/model_users.php');

    session_start();//Start the session

    //invalid is the var I am using for invalid credentials. If the search returns no matched, we populate it and display the error on screen. 
    $invalid = '';
    //on submit, we grab the entered username and password. 
    if (isPostRequest()) {
        $username = filter_input(INPUT_POST, 'userName');
        $password = filter_input(INPUT_POST, 'password');
       
        //run the search, matching the credentials with what is in the database. If the result is not empty, we log in and store appropriate vars as sessions,
        $userInfo = checkLogin($username, $password);
        if( $userInfo != []){
            $_SESSION['loggedIn'] = true;
            $password = ''; //We are now logged in, so before ANYTHING else, we reset the password variable for security. 
            $_SESSION['userID'] = $userInfo['id']; //store user ID for filtering clients later. 
            $_SESSION['isAdmin'] = $userInfo['isAdmin']; //Store admin bool for checking later. 
            header('Location: view.php'); //redirect to the upload page on successful login. 
        }
        else
            $invalid = 'Invalid Username or Password'; //Error message. 
        
        $password = ''; //Another password var reset, just in case. Perhaps unneccesary?
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style type="text/css">
        body{
            display: flex;
            justify-content: center;
        }
        #mainDiv {margin-top: 100px;}
        .col1 {width: 100px; float: left;}
        .col2 {float: left;}
        .rowContainer {clear: left; height: 40px;}
        .error {margin-left: 100px; clear: left; height: 40px; color: red;}
    </style>
<title>Client Manager </title>
</head>
<body>

    <div id="mainDiv">
        <form method="post" action="login.php">
           
            <div class="rowContainer">
                <h3>Please Login</h3>
            </div>
            <div class="error"><?= $invalid?></div> <!--This is where the error is displayed if the credentials don't match. -->
            <div class="rowContainer">
                <div class="col1">User Name:</div>
                <div class="col2"><input type="text" name="userName" value="donald"></div> 
            </div>
            <div class="rowContainer">
                <div class="col1">Password:</div>
                <div class="col2"><input type="password" name="password" value="duck"></div> 
            </div>
              <div class="rowContainer">
                <div class="col1">&nbsp;</div>
                <div class="col2"><input type="submit" name="login" value="Login" class="btn btn-dark"></div> 
            </div>
            
        </form>
        </br>
        </br>
        </br>
        <h6>Logins For Tim to Test</h6>
        <p>Admin UN: donald</p>
        <p>Admin PW: duck</p>
        <p>User UN: mickey</p>
        <p>User PW: mouse</p>
    </div>


</body>
</html>