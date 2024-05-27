<?php
include('connection.php');
$message = '';
if(isset($_POST['submit'])){
  $date = date("Y-m-d");
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  
  if($password === $cpassword){
    $encpassword = md5($password, "h123f3");
    $sql="SELECT * FROM `userstable` WHERE `Email`='".$email."'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
      $sql="SELECT * FROM `userstable` WHERE `Username`='".$uname."'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows == 0){
      $sql="INSERT INTO `userstable`(`CreatedOn`, `UpdatedOn`, `FirstName`, `LastName`, `Username`, `Email`, `ContactNo`, `Password`, `DateOfBirth`,  `Gender`, `Status`) VALUES ('$date', '$date', '$fname', '$lname', '$uname', '$email', '$phone', '$encpassword', '$dob', '$gender', 'Activate')";
      $result = mysqli_query($conn, $sql);
        if($result == true){
          $message = "User successfully created...!";
          session_start();
          $_SESSION["isuser"] = "alreadyin";
          $_SESSION["user"] = "$uname";
          header("location: ../../index.php");
        }else{
          $message = "Error in creating user....!";
        }
      }
      else{
        $message = "This user name is already taken...!";
      }
      }
      else{
        $message = "There is already an account on this email...!";
      }
  }
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blood Bank</title>
    <link rel="stylesheet" href="../../assets/css/index.css" />
    <link rel="stylesheet" href="../../assets/css/login.css" />
</head>
<body>
<div id="bodydiv">
    <header>
        <li><a href="./login.php">Login</a></li>
    </header>
    <div id="registerdiv">
        <form action="./signup.php" method="POST">
        <input id="fname" name="fname" type="text" placeholder="First Name" required>
        <input id="lname" name="lname" type="text" placeholder="Last Name" required><br>
        <input id="uname" name="uname" type="text" placeholder="Username" required><br>
        <input id="phone" name="phone" type="text" placeholder="Conatct No" required>
        <input id="email" name="email" type="text" placeholder="Email" required><br>
        <input id="password" name="password" type="password" placeholder="Password" required>
        <input id="cpassword" name="cpassword" type="password" placeholder="Repeat Password"required><br><br>
        <label>Date Of Birth: </label>
        <input id="dob" name="dob" type="date" placeholder="Date of birth" required><br><br>
        <div class="styled-select blue semi-square">
            <label>Gender</label>
        <select id="gender" name="gender">
            <option class="blue" value="Male">Male</option>
            <option class="blue" value="Female">Female</option>
            <option class="blue" value="Other">Other</option>
        </select>
        </div>
        <input type="submit" name="submit" value="Signup" id="registerbutton">
        </form>    
        <label id="messagelabel"><?php echo"$message" ?></label>
    </div>
</div>
</body>
</html>