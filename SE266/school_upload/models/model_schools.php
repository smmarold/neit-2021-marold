<?php 

    //This code is from the example code on the repository. I have commented each section to 
    // show an understanding of what each piece of code does. 
    include(__DIR__ . '/db.php');

    //function for taking the school file, reading and organizing it into a SQL statement, then uploading to our DB. 
    function insertSchoolsFromFile($fname) {
        global $db;
        $i = 0;

        //If the file doesn't exist, return from the function with a false. 
        if(!file_exists($fname)) 
            return(false);

        //Call deleteAllSchools to erase our table before uploading the new file. 
        deleteAllSchools();
        $file = fopen($fname, 'rb'); 
        $row =fgetcsv($file);

        //Loop through the file create the sql statment for each row. 
        while(!feof($file) && $i++ < 10000) {
            $row = fgetcsv($file);
/* ******************************************************************************************************************************************************************            
            I added this if statement. I was getting an error because the loop was running with the 'false' from feof as a row, i think. Everything before that inserted fine. 
            It was inserting nulls at the end of my table. Now, if that false is in the row, we simply break from the loop. Seems to have fixed the issue. 
            I will ask about this in class, because I'm not sure if this is correct or a sign that something else may be wrong. */
            if($row == false)
                break;
            //var_dump($row);
/************************************************************************************************************************************************************ */
            //grab the appropriate section of the row, storing it in the appropriate var. 
            $school = str_replace("'", "''", htmlspecialchars($row[0]));
            $city = str_replace("'", "''", htmlspecialchars($row[1]));
            $state = str_replace("'", "''", htmlspecialchars($row[2]));

            //$creating a string with all the records in it, which we will then implode in the SQL stmt while inserting. 
            $sql[] = "('" . $school . "' , '" . $city . "' , '" . $state . "')";

            //Insert into db, 1000 records at a time
            if($i % 1000 == 0){
                $db->query('INSERT INTO schools (schoolName, schoolCity, schoolState) VALUES ' . implode(',', $sql));
                $sql = array(); //reset the sql string after the upload. 
            }
        } //end while

        //if there are leftover records at the end, insert those. 
        if(count($sql))
            $db->query('INSERT INTO schools (schoolName, schoolCity, schoolState) VALUES ' . implode(',', $sql));

        return(true);

    }

    //delete all records from the schools table. Called before inserting a new file. 
    function deleteAllSchools(){
        global $db;

        $stmt = $db->query('DELETE FROM schools');
        return 0;
    }

    //Returns a count of the number of schools currently in the table. 
    function getSchoolCount() {
        global $db;
 
        $stmt = $db->query("SELECT COUNT(*) AS schoolCount FROM schools");
        $results = $stmt->fetch(PDO::FETCH_ASSOC);   
        return($results['schoolCount']);
    }

    //runs a query on the table, returning all the records that match our search terms. 
    function getSchools ($name, $city, $state) {
        global $db;
        
        $binds = array();
        $sql = "SELECT id, schoolName, schoolCity, schoolState FROM schools WHERE 0=0 ";
        //if the parameters are not empty, we append the string to the SQL statement. 
        if ($name != "") {
             $sql .= " AND schoolName LIKE :schoolName";
             $binds['schoolName'] = '%'.$name.'%';
        }
       
        if ($city != "") {
            $sql .= " AND schoolCity LIKE :city";
            $binds['city'] = '%'.$city.'%';
        }
        if ($state != "") {
            $sql .= " AND schoolState LIKE :state";
            $binds['state'] = '%'.$state.'%';
        }
        
        //run the search
        $stmt = $db->prepare($sql);
       
         $results = array();
         if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
             $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
         return ($results);
    }
    
    //Check the credentials entered on the login screen, returning true if they match, false otherwise. 
    function checkLogin ($userName, $password) {
     global $db;
     $stmt = $db->prepare("SELECT id FROM users WHERE username =:userName AND userPassword = :password");
 
     $stmt->bindValue(':userName', $userName);
     $stmt->bindValue(':password', sha1("school-salt".$password)); //rehash the password before searching, otherwise it won't work. I left the school-salt from the example code, as it made sense to me. 
     
     $stmt->execute ();
    
     return( $stmt->rowCount() > 0);
     
 }

//  $schools = getSchools('New England', '', 'RI');
//  var_dump($schools);
//  $count = getSchoolCount();
//  echo $count;

?>