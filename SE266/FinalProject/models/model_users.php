<?php 
//Include the db.php which has our connection and PDO. 
include ('db.php');

function getUsers(){
    global $db; //telling the func to use db from db.php

    $results = [];//create and initialize an array for storing results. 

    //here, we prepare our SQL statement for getting the data, and store it in the $stmt var.
    $stmt = $db->prepare("SELECT id, userFirstName, userLastName, userEmail, department, username FROM npmUsers ORDER BY userLastName");

    //Execute the statement, and if successful, store the results in our previous array. 
    if($stmt->execute() && $stmt->rowCount() > 0)
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return ($results); //i mean...should be obvious....
}

//Function for adding a client. Only Admin can add, will check prior to call.  
function addUser($fName, $lName, $uEmail, $dept, $isAdmin, $uName, $pw){
    global $db;

    //Similar to getPatients, except its a INSERT, and we use placeholders for now. 
    $stmt = $db->prepare("INSERT INTO npmUsers SET userFirstName = :userFirstName, userLastName = :userLastName, userEmail = :userEmail, department = :department, isAdmin = :isAdmin, username = :username, userPassword = :userPassword");

    //an array for binding our placeholders, using the passed parameters from the func call. 
    //This becomes the parameter passed into the execute function, telling the function what the values actually are. See below. 
    $binds = array(
        ":userFirstName" => $fName,
        ":userLastName" => $lName,
        ":userEmail" => $uEmail,
        ":department" => $dept, 
        ":isAdmin" => $isAdmin,
        ":username" => $uName,
        ":userPassword" => sha1("school-salt".$pw) 
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0) //See?
        $results = 'UserAddewd Added'; //If successful, We're just storing a string to results here. Makes it easy to echo out in HTML. 

    return ($results); //See?
}

//Updates the Client info. On the page, we will disable certain fields before calling this if the user isn't an admin, otherwise they can edit everything. 
function editUser($id, $fName, $lName, $uEmail, $dept, $isAdmin, $uName){
    global $db;

    $stmt = $db->prepare("UPDATE npmUsers SET userFirstName = :userFirstName, userLastName = :userLastName, userEmail = :userEmail, department = :department, isAdmin = :isAdmin, username = :username WHERE id = :id");
    $results = "";
    $binds = array(
        ":userFirstName" => $fName,
        ":userLastName" => $lName,
        ":userEmail" => $uEmail,
        ":department" => $dept, 
        ":isAdmin" => $isAdmin,
        ":username" => $uName,
        ":id" => $id 
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0) //Executing the statement with binds as a param, and making sure we got a result. 
        $results = 'Client Updated'; //If successful, We're just storing a string to results here. Makes it easy to echo out in HTML. 

    return ($results); 
}

//Only Admins can delete a client. 
function deleteUser($id){
    global $db;

    $results="ERROR: User Not Deleted.";
    $stmt = $db->prepare("DELETE FROM  npmUsers WHERE id=:id");
    $stmt->bindValue(':id', $id);

    //Same as others. execute the statement, and if we get a row back (success), tell the user using Result. 
    if($stmt->execute() && $stmt->rowCount() > 0)
        $results = "User Deleted";

    return ($results);
}

//Check the credentials entered on the login screen, return the results. 
function checkLogin ($userName, $password) {
    global $db;
    $results = [];
    $stmt = $db->prepare("SELECT id, isAdmin FROM npmUsers WHERE username =:userName AND userPassword = :password");

    $stmt->bindValue(':userName', $userName);
    $stmt->bindValue(':password', sha1("school-salt".$password)); //rehash the password before searching, otherwise it won't work. I left the school-salt from the example code, as it made sense to me. 
    
    if($stmt->execute() && $stmt->rowCount() > 0)
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
   
    return($results);
    
}

//Get a single client for updating and editing. 
function getOneUser($id){
    global $db;

    $results = [];
    $stmt = $db->prepare("SELECT id, userFirstName, userLastName, userEmail, department, isAdmin, username FROM npmUsers WHERE id=:id");
    $stmt->bindValue(':id', $id);
    
    if($stmt->execute() && $stmt->rowCount() > 0)
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($results);
}

?>