<?php 

    include('models/model_schools.php');
    include('includes/functions.php');

    $result = 'File Uploaded!'; //Error Var

    //Per Erik's video. Once a file is uploaded and the submit is pressed, we grab the temporary location, set a new location
    //(int this case, our uploads folder), and call the move_uploaded_file function to put the file where we want it. 
    if(isset($_FILES['file']) && $_FILES['file']['size'] > 0){
        $tmp_name = $_FILES['file']['tmp_name'];
        $path = getcwd() .  DIRECTORY_SEPARATOR . 'uploads';
        $new_name = $path . DIRECTORY_SEPARATOR . $_FILES['file']['name'];

        move_uploaded_file($tmp_name, $new_name);

        //once the file is in the appropriate folder, call the insertSchools function to get it onto the database.
        insertSchoolsFromFile($new_name);
        header('Location: search.php');
    } else 
        $result = 'No File to upload';

    include('includes/header.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        .uploadForm {
            display: flexbox;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <h1>Upload File</h1>
    <p>Please select a file to upload.</p>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="uploadForm">
            <input type="file" name="file" value="Choose File">
            <input type="submit" value="Upload">
        </div>
        <?php 
            //Temporary Comfirmation text. 
            if(isset($_FILES['file'])){
                echo $result;
            }
        ?>
    </form>

    <?php 
        include('includes/footer.php');
    ?>

</body>
</html>