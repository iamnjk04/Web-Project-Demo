<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subject</title>
    <style>
        .error {color:#FF0001;}
    </style>
        <link href = './bootstrap/css/style.css' rel = 'stylesheet'>

</head>
<?php
// if(isset($_SESSION['teacher_id'])){
    // $id = $_SESSION['teacher_id'];

 $sql = "SELECT semester_name, semester_id FROM semesters;";
 $result = mysqli_query($conn,$sql);
// }
?>

<body>

<?php

$errName=$errCredit_hr=$errSemester_id="";
    $name=$credit_hr=$semester_id="";
  if(isset($_REQUEST["submit"])){
    $name =  $_POST['subject_name'];
    $credit_hr = $_POST['credit'];
    // $address =$_POST['student_address'];
    $semester_id =$_POST['semester'];

    if(empty($name)){
        $errName= "Subject name is Blank <br>";
    }
    if(empty($credit_hr)){
        $errCredit_hr= "Credit_hr is Blank <br>";
    }
    
    if(empty($semester_id)){
        $errSemester_id= "Semester is Blank <br>";
    }
  }

?>
    <div class="login-page">
        <div class="form">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="name"> Subject Name:</label>
        <input type="text" name="subject_name" id="name" value="<?php echo $name?>"><br>
        <span class="error"><?php echo $errName;?></span> <br>
        <label for="credit">Credit Hour:</label>
        <input type="number" name="credit" id="credit" value="<?php echo $credit_hr?>"><br>
        <span class="error"><?php echo $errCredit_hr;?></span> <br>

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
    $name =  $_POST['subject_name'];
    $credit_hr = $_POST['credit'];
    // $address =$_POST['student_address'];
    $semester_id =$_POST['semester'];
    // $noofsub=$_POST['number_subject'];
  //   echo $password.length();
    $sql = "INSERT INTO subjects ( subject_name, credit_hr, semester_id) 
    VALUES ( '$name', '$credit_hr', $semester_id)";
    if(mysqli_query($conn,$sql)){
        echo "Sucess";
    }
    else{
        echo "unsucess".mysqli_error($conn);
    }
    // header("Location:dashboard.php");
  }
?>