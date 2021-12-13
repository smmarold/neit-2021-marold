<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stephen Marold's Site</title>
    <style>
        .navbar{
            background-color:#404040;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.5em;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            color: white;        }
        .navbar a {
            padding: 15px;
            color: white;
        }

    </style>
</head>
<body>
<div class = 'navbar'>
        <a href="./index.php">Home</a>
        <a href="https://github.com/smmarold/neit-2021-smarold/tree/main/SE266" target="_blank">GitHub Repo</a>
        <a href="./phpResources.php">PHP Resources</a>
        <a href="./gitResources.php">GitHub Resources</a>
        <a href="./hobbies.php">What I Do</a>
    </div>
    <div id='header-bar'><h1>Stephen Marold</h1></div>
    <p>This is my page, where I show off how awesome I am! Hope you like it!</p>

    <h2>My Assignments</h2>
    <ul>
        <li><a href="../fizz_buzz/fizzBuzz.php">Week 1-Fizz Buzz</a></li>
        <li><a href="../intake_form/intakeform.php">Week 2 Intake Form</a></li>
        <li><a href="../atm/atm.php">Week 3 ATM App</a></li>
        <li><a href="../patient_records/view.php">Week 4 View and Add Patients</a></li>
        <li><a href="../patient_records_wk5/view.php">Week 5 Patient CRUD</a></li>
        <li><a href="../school_upload/login.php">Week 6 School Upload</a></li>
        <li><a href="../patient_records_wk7/login.php">Week 7 Patient Records w/ Login</a></li>
        <li><a href="./placeholder.php">Week 8</a></li>
        <li><a href="../FinalProject/login.php" >Week 10 Final Project</a></li>
    </ul>
    <?php include('footer.php'); ?>