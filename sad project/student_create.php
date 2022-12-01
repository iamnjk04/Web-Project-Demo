<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <style>
        .error {color:#FF0001;}
    </style>
            <link href = './bootstrap/css/style.css' rel = 'stylesheet'>

</head>
<?php
 $sql = "SELECT semester_name, semester_id FROM semesters;";
 $result = mysqli_query($conn,$sql);
?>

<body>
    <?php
    $errName=$errDob=$errAddress=$errSemester_id="";
    $name=$dob=$address=$semester_id="";

    
    if(isset($_REQUEST["submit"])){
        $name =  $_POST['student_name'];
        $dob = $_POST['student_dob'];
        $address =$_POST['student_address'];
        $semester_id =$_POST['semester'];

        if(empty($name)){
            $errName= "Name is Blank <br>";
        }
        if(empty($dob)){
            $errDob= "DOB is Blank <br>";
        }
        
        if(empty($address)){
            $errAddress="Address is Blank <br>";
        }
        
        if(empty($semester_id)){
            $errSemester_id= "Semester is Blank <br>";
        }

    }
    ?>



<div class="login-page">
        <div class="form">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="name"> Name:</label>
        <input type="text" name="student_name" id="name" value="<?php echo $name?>"> <br>
        <span class="error"><?php echo $errName;?></span> <br>
        <label for="dob">DOB:</label>
        <input type="date" name="student_dob" id="dob" value="<?php echo $dob?>"> <br>
        <span class="error"><?php echo $errDob;?></span> <br>
        <label for="name">Address</label>
        <input type="text" name="student_address" id="address" value="<?php echo $address?>"><br>
        <span class="error"><?php echo $errAddress;?></span> <br>
        <label for="semester_name">Semester Name:</label>
        <select name="semester" id="semester" value="<?php echo $semester_id?>">
            <?php
                while($row = mysqli_fetch_array($result)){
                    echo '<option value='.$row['semester_id'].'>'.$row['semester_name'].'</option>';
                }
            ?>
        </select><br>
        <span class="error"><?php echo $errSemester_id;?></span> <br>
        <!-- <input type="submit" value="Submit" name="submit"> -->
        <button name = 'submit'> submit</submit>

    </form>
            </div>
            </div>
</body>
</html>
<?php


  if(isset($_REQUEST["submit"])){
    $name =  $_POST['student_name'];
    $dob = $_POST['student_dob'];
    $address =$_POST['student_address'];
    $semester_id =$_POST['semester'];
    // $noofsub=$_POST['number_subject'];
  //   echo $password.length();
    $sql = "INSERT INTO students ( student_name, student_dob, student_address, semester_id) 
    VALUES ( '$name', '$dob', '$address', $semester_id)";
    if(mysqli_query($conn,$sql)){
        echo "Sucess";
    }
    else{
        echo "unsucess".mysqli_error($conn);
    }
    header("Location:dashboard.php");
  }
?>