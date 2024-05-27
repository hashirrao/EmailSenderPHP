<?php
    include('connection.php');
    if(isset($_POST["reciepentemail"])){
        $date = date("Y-m-d");
        $useremail = $_POST["useremail"];
        $reciepentemail = $_POST["reciepentemail"];
        $useremail = $_POST["useremail"];
        $sql = "INSERT INTO `EmailsTable` (`EmailAdd`, `UserEmail`, `EnteredOn`, `UpdatedOn`) VALUES ('$reciepentemail', '$useremail', '$date', '$date')";
        $result = mysqli_query($conn, $sql);
        if($result == true){
            
        }
        else{
            echo "Error in insertion...";
        }
    }
?>