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
    </style>
</head>
<body>
    <h1>Patient Intake Form</h1>
    <form action="intakeform.php" method="post">
        <div class="wrapper">
            <div><label class="fieldLabel">First Name: </label></div>
            <div><input type="text" name="firstName"/></div>
            <div><label class="fieldLabel">Last Name: </label></div>
            <div><input type="text" name="lastName"/></div>

            <div><label class="fieldLabel">Married: </label></div>
            <div><input type="radio" value="Y" name="gender">Y
            <input type="radio" value="N" name="gender">N</div>

            <div><label class="fieldLabel">Birthday: </label></div>
            <div><input type="text" name="birthday"/></div>

            <div><label class="fieldLabel">Height: </label></div>
            <div><label>Ft: </label>
            <input type="text" name="heightFeet" size="3" />
            <label>In: </label>
            <input type="text" name="heightInches" size="3"/></div>
            <div><label class="fieldLabel">Weight: </label></div>
            <div><input type="text" name="weight" size="4"/> lbs<br /></div>
            <div><input type="submit" name="submitBtn" /></div>
        </div>
    </form>
</body>
</html>
