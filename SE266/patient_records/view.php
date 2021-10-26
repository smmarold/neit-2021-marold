<?php 
    //Include model file for get/add functions, as well as functions (for getAge() later in the file)
    include('functions.php');
    include('./model/model_patients.php');
    //Call getPatients, and store in var. Will loop through later. 
    $patients = getPatients();
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
</head>
<body>
    <div class="container">
        <div class="col-sm-offset-2 col-sm-10">
            <h1>Patient Records</h1>
            <a href="./patientIntake.php">Add Patient</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Married</th>
                        <th>Birthday</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <!-- Here, we loop through our results from earlier, and create a row in the table for each record returned. -->
                <tbody>
                    <?php foreach ($patients as $patient){?>
                        <tr>
                            <td><?= $patient['id']; ?></td>
                            <td><?= $patient['patientFirstName']; ?></td>
                            <td><?= $patient['patientLastName']; ?></td>
                            <td><?php 
                                //Since 'patientMarried' is a tinyint, I am doing a quick check, and echoing a string for improved UX
                                //After Birthday, I created another field, where I call getAge() from functions.php and pass it that records bDay. 
                                if($patient['patientMarried'] == 1)
                                    echo "YES";
                                else 
                                    echo "NO" ?></td>
                            <td><?= $patient['patientBirthDate']; ?></td>
                            <td><?= getAge($patient['patientBirthDate']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <br />
            <a href="./patientIntake.php">Add Patient</a>
        </div>
    </div>
</body>
</html>