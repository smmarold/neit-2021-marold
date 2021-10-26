<?php 
//Include the db.php which has our connection and PDO. 
include __DIR__ . '/db.php';

//returns all records in patients table. 
function getPatients(){
    global $db; //telling the func to use db from db.php

    $results = [];//create and initialize an array for storing results. 

    //here, we prepare our SQL statement for getting the data, and store it in the $stmt var.
    $stmt = $db->prepare("SELECT id, patientFirstName, patientLastName, patientMarried, patientBirthDate FROM patients ORDER BY patientLastName");

    //Execute the statement, and if successful, store the results in our previous array. 
    if($stmt->execute() && $stmt->rowCount() > 0)
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return ($results); //i mean...should be obvious....
}

//Funcction for adding a patient. Takes in the parameters needed to fill a record in our patients table. 
function addPatient($fName, $lName, $m, $bd){
    global $db;

    //Similar to getPatients, except its a INSERT, and we use placeholders for now. 
    $stmt = $db->prepare("INSERT INTO patients SET patientFirstName = :patientFirstName, patientLastName = :patientLastName, patientMarried = :patientMarried, patientBirthDate = :patientBirthDate");

    //an array for binding our placeholders, using the passed parameters from the func call. 
    //This becomes the parameter passed into the execute function, telling the function what the values actually are. See below. 
    $binds = array(
        ":patientFirstName" => $fName,
        ":patientLastName" => $lName,
        ":patientMarried" => $m,
        ":patientBirthDate" => $bd
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0) //See?
        $results = 'Patient Added'; //If successful, We're just storing a string to results here. Makes it easy to echo out in HTML. 

    return ($results); //See?
}

?>