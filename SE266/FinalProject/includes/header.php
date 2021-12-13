<?php
    session_start();

    //check if the session exists, if not, redirect to login page. 
    //It may be unnecessary to also check if the session logged in is false, but I felt it was safer to do so. 
    if(!isset($_SESSION['loggedIn']))
        header('Location: login.php');
    elseif(!$_SESSION['loggedIn'])
        header('Location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Client Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
        #mainDiv {margin-left: 100px; margin-top: 100px;}
        .col1 {width: 100px; float: left;}
        .col2 {float: left;}
        .rowContainer {clear: left; height: 40px;}
        .error {margin-left: 100px; clear: left; height: 40px; color: red;}
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
        }
        
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <span class="navbar-brand">Nova Pro Media Client Manager</span>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'view.php'): ?>class="active"<?php endif; ?>><a href="view.php">View Clients</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'editClient.php'): ?>class="active"<?php endif; ?>>
          <?php if($_SESSION['isAdmin']){ ?> <a href="editClient.php?action=Add">Add Client</a> <?php } ?></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'viewUsers.php'): ?>class="active"<?php endif; ?>>
          <?php if($_SESSION['isAdmin']){ ?> <a href="viewUsers.php">Add/Edit User</a> <?php } ?></li>
        <li><a href="logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
  </div>
</nav>