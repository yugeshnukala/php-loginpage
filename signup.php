<html>
<head>
<title>SignUp</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php

   function displayMessage($bottomMessage) {
       echo "<div class='bottom-message'><h3> $bottomMessage </h3></div>";
   }

    function performPostRequest($conn) {
        $fname =   $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $pswd = $_POST['pswd'];
        $addr = $_POST['addr'];
        $regno = $_POST['regno'];

        $query = "INSERT INTO `tbl_signup`(`fname`, `lname`, `dob`, `gender`, `email`, `password`, `address`, `regno`) VALUES 
                    ('$fname','$lname','$dob','$gender','$email','$pswd','$addr','$regno')"; 
        $checkUserExist_query = "SELECT * FROM `tbl_signup` WHERE `regno`='' AND `email`=''";
        $checkUserExist_result = mysqli_query($conn,$checkUserExist_query);
        if(mysqli_num_rows($checkUserExist_result)>0) {
            echo "<p class='error-msg'>User already exist</p>";
        }
        else{
            mysqli_query($conn,$query);
            displayMessage("Added to Database");
        }
    }

    function closeConnection($conn) {
        mysqli_close($conn);
    }
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword,'db_sample');
    if(! $conn ) {
        die('Could not connect:  '.mysqli_error());
    }
    if(isset($_POST['submit'])){
        performPostRequest($conn);
        closeConnection($conn);
    }
?>

</body>
<form action="" method="post">
    <label for="firstname">FirstName:</label>
    <input type="text" name="fname" id="firstname">
    <br>

    <label for="lastname">LastName:</label>
    <input type="text" name="lname" id="lastname">
    <br>

    <label for="dob">DOB:</label>
    <input type="date" name="dob" id="dob">
    <br>

    <label for="gender">Gender:</label>
    <input type="text" name="gender" id="gender">
    <br>

    <label for="email">Email:</label>
    <input type="text" name="email" id="email">
    <br>

    <label for="pswd">Password:</label>
    <input type="password" name="pswd" id="pswd">
    <br>

    <label for="address">Address:</label>
    <input type="text" name="addr" id="address">
    <br>

    <label for="rno">Register No:</label>
    <input type="text" name="regno" id="rno">
    <br>

    <input type="submit" value="Submit" name="submit">

</form>
<style>
    .error-msg {
        color: red;
    }
</style>
</html>