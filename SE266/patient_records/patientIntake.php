<?php 
    //Since this intake form is so similar to our previous form on another lab, I copied it over
    // This way I could simply remove the unneccessary fields, and still have the form validation. 
    include('models/model_patients.php');

    //Initialize Error and Married
    $error = '';
    $married = '';
    //If the Form was submitted, we get all of the values and store them in vars. 
    if(isset($_POST['submitBtn'])){
        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        if(isset($_POST['married']))
            $married = $_POST['married'];
        $birthday = filter_input(INPUT_POST, 'birthday');
        
        //If any of the vlaues are blank or invalid, we add an error message to our Var, and display that in Red at the beginning of the form. 
        if($firstName == "")
            $error .= "<p>First Name is Required.</p>";
        if($lastName == "")
            $error .= "<p>Last Name is Required.</p>";
        if($married == "")
            $error .= "<p>Marital Status is Required.</p>";
        if($birthday == '')
            $error .= "<p>Birthday is Required.</p>";

        //If our error var contains no errors, we use the vars we captured to process a new Patient to the database. 
        if($error == '')
            $results = addPatient($firstName, $lastName, $married, $birthday);
    }
    else {
        //If the form wasn't submitted, it's the page's initial load, and we set the vars as blank. 
        $firstName = "";
        $lastName = "";
        $married = "";
        $birthday = "";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intake Form</title>
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
    </style>
</head>
<body>
    <h1>Patient Intake Form</h1>
    <!-- If our $error var has anything in it, it will display here on submit. -->
    <?= $error;?>
    <!--Begin Form -->
    <form action="patientIntake.php" method="post">
        <div class="wrapper">
            <div><label class="fieldLabel">First Name: </label></div>
            <div><input type="text" name="firstName" value="<?= $firstName; ?>"/></div>
            <div><label class="fieldLabel">Last Name: </label></div>
            <div><input type="text" name="lastName" value="<?= $lastName; ?>"/></div>

            <div><label class="fieldLabel">Married: </label></div>
            <div><input type="radio" value=1 name="married" value="<?= $married; ?>">Y
            <input type="radio" value=0 name="married" value="<?= $married; ?>">N</div>

            <div><label class="fieldLabel">Birthday (mm/dd/yyy): </label></div>
            <div><input type="date" name="birthday" value="<?= $birthday; ?>"/></div>

            <div><input type="submit" name="submitBtn" value="Process Patient"/></div>
            <br />
            <br />
            <!-- If our form was submitted and we have no errors, it means the addPatient() func was called. Below we display the 
                results (in this case a successful add just returns "Patient Added" so that's what we display) -->
            <?php 
                if(isset($_POST['submitBtn']) && $error == ''){
                    echo $results;
                }
            ?>
        </div>
    </form>
    <a href="./view.php">View Patients</a>
</body>
</html>