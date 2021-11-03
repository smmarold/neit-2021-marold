<?php 
    //This form is similar to the original Intake form. We now include ways to edit and update the Patient in our records. 
    //I was also able to keep basic form validation from the previous lab (just checking that everything is filled out)
    include('functions.php');
    include('models/model_patients.php');

    //initialize variables that need initializing. 
    //If not initialized every page load, these (except error) will throw errors if left blank and a blank form is submitted.
    $error = "";
    $married = "";
    $yes = "";
    $no = "";
    //Figure out if we are updating or adding a patient, and what our action is.  
    if(isset($_GET['action'])) {
        // If the action is GET, we passed params through the URL, meaning we are updating. We grab the action and id passed and store them in Vars.
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'patientId');
        //If the action is Update, call getOnPatient using the Id, and fill our fields with that patient's info. 
        if($action == "Update"){
            $patient = getOnePatient($id);
            $firstName = $patient['patientFirstName'];
            $lastName = $patient['patientLastName'];
            $married = $patient['patientMarried'];
            $birthday = $patient['patientBirthDate'];
        } else { //If not, the fields will be blank.
            $firstName = "";
            $lastName = "";
            $married = "";
            $birthday = "";
            $yes = "";
            $no = "";
        } 
    } elseif (isset($_POST['action'])){ 
        //If the action is a post (a button was clicked), we grab all the field values and store them in vars.
        $action = filter_input(INPUT_POST, 'action');
        $id = filter_input(INPUT_POST, 'patientId');
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
    }

    //If the action is ADD and the request was a post (the button was clicked), call addPatient with the values we stored earlier. 
    //I also added a check on the error variable to Erik's code, so we can do basic validation. The functions will only fire if there
    // are no blanks in the fields. 
    if(isPostRequest() && $action == "Add" && $error == "") {
        $results = addPatient($firstName, $lastName, $married, $birthday);
        echo $results;
        header('Location: view.php');
    //Else, if the action is UPDATE and the request was a post, call updatePatient with the values we passed earlier. 
    // Includes the same check of the error variable as Add. 
    } elseif(isPostRequest() && $action == "Update" && $error == ""){
        $results = updatePatient($id, $firstName, $lastName, $married, $birthday);
        echo $results;
        header('Location: view.php');
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
    <?= $error;?> <!-- If our error Var contains anything, display those errors on the page.  -->
    <!--Begin Form -->
    <form action="patientEdit.php" method="post">
        <div class="wrapper">
            <!-- Hidden input fields for getting and storing the actiona and ID values. -->
            <div><input type="hidden" name="action" value="<?= $action; ?>"/></div>
            <div><input type="hidden" name="patientId" value="<?= $id; ?>"/></div>
            

            <div><label class="fieldLabel">First Name: </label></div>
            <div><input type="text" name="firstName" value="<?= $firstName; ?>"/></div>
            <div><label class="fieldLabel">Last Name: </label></div>
            <div><input type="text" name="lastName" value="<?= $lastName; ?>"/></div>

            <?php 
                //quick conversion of married to a bool and checking the appropriate box. if the string is blank (add patient for a blank form), niether should be checked. 
                //I am nearly positive there is a better way to do this... But this is what I came up with. 
                if($married == 1){
                    $yes = 'checked';
                    $no = '';
                }
                elseif ($married == 0){
                    $yes = '';
                    $no = 'checked';
                }
            ?>
            <div><label class="fieldLabel">Married: </label></div>
            <div><input type="radio" value=1 name="married" <?= $yes; ?>>Y
            <input type="radio" value=0 name="married" <?= $no; ?>>N</div>

            <div><label class="fieldLabel">Birthday (mm/dd/yyy): </label></div>
            <div><input type="date" name="birthday" value="<?= $birthday; ?>"/></div>
            <div><button type="submit" name="submitBtn"><?= $action; ?> Patient</button></div>
            <br />
            <br />
        </div>
    </form>
    <a href="./view.php">View Patients</a>
</body>
</html>