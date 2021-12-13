<?php 
    //editClients will also allow adding of clients depending on where we came from. Both users and admins will use this page, 
    //however, the page will change what can be edited based on who is logged in. 
    include('includes/functions.php');
    include('models/model_clients.php');
    include('models/model_users.php');
    include('includes/header.php');

    //initialize variables that need initializing. 
    $busName = '';
    $conName = '';
    $email = '';
    $phone = '';
    $website = '';
    $assdUser = '';
    $userNotes = '';
    $error = '';
    $userList = getUsers(); //get all users from DB and store here. Later we use this to populate our dropdown. 

    //Figure out if we are updating or adding a client, and what our action is.  
    if(isset($_GET['action'])) {
        // If the action is GET, we passed params through the URL, meaning we are updating. We grab the action and id passed and store them in Vars.
        $action = filter_input(INPUT_GET, 'action');
        $id = filter_input(INPUT_GET, 'clientId');
        //If the action is Update, call getOneClient using the Id, and fill our fields with that patient's info. 
        if($action == "Update"){
            $client = getOneClient($id);
            $busName = $client['businessName'];
            $conName = $client['contactName'];
            $email = $client['contactEmail'];
            $phone = $client['contactPhone'];
            $website = $client['websiteAddress'];
            $assdUser = $client['assignedUser'];
            $userNotes = $client['userNotes'];
        } else { //If not, the fields will be blank.
            $busName = '';
            $conName = '';
            $email = '';
            $phone = '';
            $website = '';
            $assdUser = '';
            $userNotes = '';
        } 
    } elseif (isset($_POST['action'])){ 
        //If the action is a post (a button was clicked), we grab all the field values and store them in vars.
        $action = filter_input(INPUT_POST, 'action');
        $id = filter_input(INPUT_POST, 'clientId');
        $busName = filter_input(INPUT_POST, 'busName');
        $conName = filter_input(INPUT_POST, 'conName');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $website = filter_input(INPUT_POST, 'website');
        if($_SESSION['isAdmin'])
            $assdUser = filter_input(INPUT_POST, 'users');
        else
            $assdUser = $_SESSION['userID'];
        $userNotes = filter_input(INPUT_POST, 'userNotes');
        
        //If any of the vlaues are blank or invalid, we add an error message to our Var, and display that in Red at the beginning of the form. 
        if($busName == "")
            $error .= "<p>Business Name is Required.</p>";
        if($conName == "")
            $error .= "<p>Contact Name is Required.</p>";
        if($email == "")
            $error .= "<p>Contact Email is Required.</p>";
        if($phone == '')
            $error .= "<p>Contact Phone Number is Required.</p>";
        if($assdUser == '')
            $assdUser = 0;
    } else
        header('Location: view.php');
    
    //If the action is ADD and the request was a post (the button was clicked), call addClient with the values we stored earlier. 
    //I also added a check on the error variable to Erik's code, so we can do basic validation. The functions will only fire if there
    // are no blanks in the fields. 
    if(isPostRequest() && $action == "Add" && $error == "") {
        $results = addClient($busName, $conName, $email, $phone, $website, $assdUser, $userNotes);
        echo $results;
        header('Location: view.php');
    //Else, if the action is UPDATE and the request was a post, call updatePatient with the values we passed earlier. 
    // Includes the same check of the error variable as Add. 
    } elseif(isPostRequest() && $action == "Update" && $error == ""){
        $results = updateClient($id, $busName, $conName, $email, $phone, $website, $assdUser, $userNotes);
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
                grid-template-columns: 500px 300px;
            }
        p {
            color: red;
        }
        .notes{
            margin-left: 20px;
            margin-top: 75px;
        }
        .form{
            margin:10px;
            display: grid;
            grid-template-columns: 150px 300px;
        }
        .button{
            margin-left: 10px;
        }
        .fullPage{
            margin-left: 25%;
        }
    </style>
</head>
<body>
    <div class="fullPage">
    <h1>Add/Edit Client</h1>
    </br>
    <?= $error;?> <!-- If our error Var contains anything, display those errors on the page.  -->
    <!--Begin Form -->
    <form action="editClient.php" method="post">
        <div class="wrapper">
            <div class="form">
            <!-- Hidden input fields for getting and storing the actiona and ID values. -->
            <div><input type="hidden" name="action" value="<?= $action; ?>"/></div>
            <div><input type="hidden" name="clientId" value="<?= $id; ?>"/></div>
            
            <!-- For business name and assigned user, check for admin and disable if necessary. -->
            <div><label class="fieldLabel">Business Name: </label><div><?php if(!$_SESSION['isAdmin']){ echo $busName; }?></div></div>
            <div><input <?php if($_SESSION['isAdmin']){ ?> type="text" <?php } else { ?> type="hidden" <?php } ?> name="busName" value="<?= $busName; ?>"/></div>
            <div><label class="fieldLabel">Contact Name: </label></div>
            <div><input type="text" name="conName" value="<?= $conName; ?>"/></div>
            <div><label class="fieldLabel">Email: </label></div>
            <div><input type="text" name="email" value="<?= $email; ?>"/></div>
            <div><label class="fieldLabel">Phone: </label></div>
            <div><input type="text" name="phone" value="<?= $phone; ?>"/></div>
            <div><label class="fieldLabel">Website: </label></div>
            <div><input type="text" name="website" value="<?= $website; ?>"/></div>

            <!-- Here is the dropdown code. If the user is NOT an admin, this will be omitted from the page entirely. 
                 Otherwise, loop through the variable we grabbed earlier and populate the dropdown-->
            <?php if($_SESSION['isAdmin']){ ?>
                <div><label class="fieldLabel">Assigned User: </label></div>
                <select name="users" id="users">
                    <?php 
                        foreach($userList as $user){
                            if($assdUser === $user['id']) //If the client already has an assigned user, the dropdown will have that user already selected. 
                                echo '<option value = "' .htmlspecialchars($user['id']) . '" selected >';
                            else
                            echo '<option value = "' .htmlspecialchars($user['id']) . '">';
                            echo htmlspecialchars($user['userFirstName']) . ' ' .htmlspecialchars($user['userLastName']);
                            echo '</option>';
                        }
                    ?>
                </select>
            <?php } ?>
            </div>
            <div class="notes">
                <div><label class="fieldLabel">User Notes (250 Char Max): </label></div>
                <div><textarea id="userNotes" name="userNotes" value="<?= $userNotes; ?>" rows="10" cols="50" ><?= $userNotes; ?></textarea></div>
            </div>

            <div class="button"><button type="submit" name="submitBtn"><?= $action; ?> Client</button></div>
        </div>
    </form>
    </br>
    </br>
    <a href="./view.php">Return to View Clients</a>
    </div>
</body>
</html>