<?php 
    //Include the functions php doc for our BMI and Age funcs
    include __DIR__ . './functions.php';

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
        $htFeet = filter_input(INPUT_POST, 'heightFeet', FILTER_VALIDATE_INT);
        $htInches = filter_input(INPUT_POST, 'heightInches', FILTER_VALIDATE_INT);
        $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_INT);

        //If any of the vlaues are blank or invalid, we add an error message to our Var, and display that in Red at the beginning of the form. 
        if($firstName == ""){
            $error .= "<p>First Name is Required.</p>";
        }
        if($lastName == ""){
            $error .= "<p>Last Name is Required.</p>";
        }
        if($married == ""){
            $error .= "<p>Marital Status is Required.</p>";
        }
        if($birthday == ''){
            $error .= "<p>Birthday is Required.</p>";
        if(!is_int($htFeet) || $htFeet < 0 || $htFeet > 8){
            $error .= "<p>Feet Must be a valid number.</p>";
        }
        if(!is_int($htInches))
            $error .= "<p>Inches Must be a whole number.</p>";
        }
        if(!is_int($weight) || $weight < 0 || $weight > 1000){
            $error .= "<p>Please make weight a whole number.</p>";
        }
    }
    else {
        //If the form wasn't submitted, it's the page's initial load, and we set the vars as blank. 
        $firstName = "";
        $lastName = "";
        $married = "";
        $birthday = "";
        $htFeet = "";
        $htInches = "";
        $weight = "";
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
    <form action="intakeform.php" method="post">
        <div class="wrapper">
            <div><label class="fieldLabel">First Name: </label></div>
            <div><input type="text" name="firstName" value="<?= $firstName; ?>"/></div>
            <div><label class="fieldLabel">Last Name: </label></div>
            <div><input type="text" name="lastName" value="<?= $lastName; ?>"/></div>

            <div><label class="fieldLabel">Married: </label></div>
            <div><input type="radio" value="Y" name="married" value="<?= $married; ?>">Y
            <input type="radio" value="N" name="married" value="<?= $married; ?>">N</div>

            <div><label class="fieldLabel">Birthday (mm/dd/yyy): </label></div>
            <div><input type="date" name="birthday" value="<?= $birthday; ?>"/></div>

            <div><label class="fieldLabel">Height: </label></div>
            <div><label>Ft: </label>
            <input type="text" name="heightFeet" size="3" value="<?= $htFeet; ?>"/>
            <label>In: </label>
            <input type="text" name="heightInches" size="3" value="<?= $htInches; ?>"/></div>
            <div><label class="fieldLabel">Weight: </label></div>
            <div><input type="text" name="weight" size="4" value="<?= $weight; ?>"/> lbs<br /></div>
            <div><input type="submit" name="submitBtn" /></div>
            <br />
            <br />
            <!-- If our form was submitted and we have no errors, call the BMI and Age functions
                using the information we got on submit, then diplay the results below the form. -->
            <?php 
                if(isset($_POST['submitBtn']) && $error == ''){
                    $age = getAge($birthday);
                    $BMI = calcBMI($htFeet, $htInches, $weight);
                    $classification = bmiClassifier($BMI);
            ?>
                <div class="fieldLabel">Patient Age: <?= $age?></div><br />
                <div class="fieldLabel">Patient BMI: <?= $BMI?></div><br />
                <div class="fieldLabel">BMI classification: <?= $classification?></div>
            <?php        
                }
            ?>
        </div>
    </form>
</body>
</html>