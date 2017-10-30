<?php
// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($_POST["submit"] == "Upload"){
        // Check if file was uploaded without errors
        if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
            $allowed = array("pdf" => "application/pdf");
            $filename = $_FILES["file"]["name"];
            $filetype = $_FILES["file"]["type"];
            $filesize = $_FILES["file"]["size"];
        
            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        
            // Verify file size - 5MB maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
        
            // Verify MYME type of the file
            if(in_array($filetype, $allowed)){
                // Check whether file exists before uploading it
                if(file_exists("upload/" . $_FILES["file"]["name"])){
                    echo $_FILES["file"]["name"] . " is already uploaded.";
                }
                else if(file_exists("approved/" . $_FILES["file"]["name"])){
                    echo $_FILES["file"]["name"] . " is already uploaded and approved.";
                } 
                else if (file_exists("rejected/" . $_FILES["file"]["name"])){
                    #TO ADD delete file from rejected
                    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
                    echo "Your file was uploaded successfully.";
                }
                else{
                    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
                    echo "Your file was uploaded successfully.";
                } 
            } 
            else{
                echo "Error: There was a problem uploading your file. Please try again."; 
            }
        }
        else{
            echo "Error: " . $_FILES["file"]["error"];
        }
    }
    if ($_POST["submit"] == "Approve"){
        copy ("upload/".$_POST["file"], "approved/".$_POST["file"]);
        unlink ("upload/".$_POST["file"]);
         echo $_POST["file"]." was approved successfully.";
    }
    if ($_POST["submit"] == "Reject"){
        copy ("upload/".$_POST["file"], "rejected/".$_POST["file"]);
        unlink("upload/".$_POST["file"]);
        echo $_POST["file"]." was rejected successfully.";
    }
     if ($_POST["submit"] == "Delete"){
        unlink($_POST["folder"].$_POST["file"]); 
        echo $_POST["file"]." was deleted successfully.";
    }


    echo "<form action='login.php'method='post'>";
    echo "<input type='hidden' value=".$_POST["name"]." name='name'/><br>";
    echo "<input type='hidden' value=".$_POST["password"]." name='password'/><br>";
    echo "<input type='submit' name='submit' value='Go back'><br>";
    echo "</form>";
}
?>