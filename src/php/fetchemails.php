<?php
    include('connection.php');
    $email = $_POST["searchemail"];
    $useremail = $_POST["useremail"];
    $sql = "SELECT * FROM EmailsTable WHERE `EmailAdd` LIKE '%$email%' AND `UserEmail`='$useremail'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        $i=0;
        while($row = $result->fetch_assoc()){
            echo "<tr><td width='98%'>".$row["EmailAdd"]."</td><td width='2%'><input id='checkbox$i' value=".$row["EmailAdd"]." type='checkbox' onclick='tablecheckboxesclick()' /></tr>";
            $i++;
        }   
    }
    else{
        echo "0 Result";
    }    
?>