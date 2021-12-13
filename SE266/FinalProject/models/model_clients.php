<?php 
//Include the db.php which has our connection and PDO. 
include ('db.php');

//If id is empty, it means an admin is logged in (will check prior to call), and return all clients. 
//Otherwise, pass id of logged in user and return only clients with that user assigned 
function getClients($id){
    global $db; //telling the func to use db from db.php

    $results = [];//create and initialize an array for storing results. 

    //here, we prepare our SQL statement for getting the data, and store it in the $stmt var.
    $sql = "SELECT id, businessName, contactName, contactEmail, contactPhone, websiteAddress, userNotes FROM clients WHERE 0=0";
    if ($id != "") {
        $sql .= " AND assignedUser LIKE :assignedUser";
        $binds['assignedUser'] = '%'.$id.'%';
    }
    else 
        $binds = [];

    $stmt = $db->prepare($sql);
    //Execute the statement, and if successful, store the results in our previous array. 
    if($stmt->execute($binds) && $stmt->rowCount() > 0)
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return ($results); //i mean...should be obvious....
}

//Funcction for adding a client. Only Admin can add, will check prior to call.  
function addClient($bName, $cName, $cEmail, $cPhone, $webAdd, $assdUser, $uNotes){
    global $db;

    //Similar to getPatients, except its a INSERT, and we use placeholders for now. 
    $stmt = $db->prepare("INSERT INTO clients SET businessName = :businessName, contactName = :contactName, contactEmail = :contactEmail, contactPhone = :contactPhone, websiteAddress = :websiteAddress, assignedUser = :assignedUser, userNotes = :userNotes");

    //an array for binding our placeholders, using the passed parameters from the func call. 
    //This becomes the parameter passed into the execute function, telling the function what the values actually are. See below. 
    $binds = array(
        ":businessName" => $bName,
        ":contactName" => $cName,
        ":contactEmail" => $cEmail,
        ":contactPhone" => $cPhone, 
        ":websiteAddress" => $webAdd,
        ":assignedUser" => $assdUser,
        ":userNotes" => $uNotes 
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0) //See?
        $results = 'Client Added'; //If successful, We're just storing a string to results here. Makes it easy to echo out in HTML. 

    return ($results); //See?
}

//Updates the Client info. On the page, we will disable certain fields before calling this if the user isn't an admin, otherwise they can edit everything. 
function updateClient($id, $bName, $cName, $cEmail, $cPhone, $webAdd, $assdUser, $uNotes){
    global $db;

    $stmt = $db->prepare("UPDATE clients SET businessName = :businessName, contactName = :contactName, contactEmail = :contactEmail, contactPhone = :contactPhone, websiteAddress = :websiteAddress, assignedUser = :assignedUser, userNotes = :userNotes WHERE id = :id");
    $results = "";
    $binds = array(
        ":businessName" => $bName,
        ":contactName" => $cName,
        ":contactEmail" => $cEmail,
        ":contactPhone" => $cPhone, 
        ":websiteAddress" => $webAdd,
        ":assignedUser" => $assdUser, 
        ":userNotes" => $uNotes, 
        ":id" => $id 
    );

    if($stmt->execute($binds) && $stmt->rowCount() > 0) //Executing the statement with binds as a param, and making sure we got a result. 
        $results = 'Client Updated'; //If successful, We're just storing a string to results here. Makes it easy to echo out in HTML. 

    return ($results); 
}

//Only Admins can delete a client. 
function deleteClient($id){
    global $db;

    $results="ERROR: Client Not Deleted.";
    $stmt = $db->prepare("DELETE FROM  clients WHERE id=:id");
    $stmt->bindValue(':id', $id);

    //Same as others. execute the statement, and if we get a row back (success), tell the user using Result. 
    if($stmt->execute() && $stmt->rowCount() > 0)
        $results = "Client Deleted";

    return ($results);
}


//Users can filter clients by business name, contact name, or website
function searchClients ($bName, $cName, $website, $uid) {
    global $db;
    
    $binds = array();
    $sql = "SELECT id, businessName, contactName, contactEmail, contactPhone, websiteAddress, userNotes FROM clients WHERE 0=0 ";
    //if the parameters are not empty, we append the string to the SQL statement. 
    if ($bName != "") {
         $sql .= " AND businessName LIKE :businessName";
         $binds['businessName'] = '%'.$bName.'%';
    }
   
    if ($cName != "") {
        $sql .= " AND contactName LIKE :contactName";
        $binds['contactName'] = '%'.$cName.'%';
    }
    if ($website != "") {
        $sql .= " AND websiteAddress LIKE :websiteAddress";
        $binds['websiteAddress'] = '%'.$website.'%';
    }
    if ($uid != "") {
        $sql .= " AND assignedUser LIKE :assignedUser";
        $binds['assignedUser'] = '%'.$uid.'%';
    }
    
    //run the search
    $stmt = $db->prepare($sql);
   
     $results = array();
     if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
         $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
     return ($results);
}

//Get a single client for updating and editing. 
function getOneClient($id){
    global $db;

    $results = [];
    $stmt = $db->prepare("SELECT id, businessName, contactName, contactEmail, contactPhone, websiteAddress, assignedUser, userNotes FROM clients WHERE id=:id");
    $stmt->bindValue(':id', $id);
    
    if($stmt->execute() && $stmt->rowCount() > 0)
        $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($results);
}

?>