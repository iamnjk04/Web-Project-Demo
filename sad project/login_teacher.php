<?php
   include("config.php");
   session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .error {color:#FF0001;}

    </style>
    <link href = './bootstrap/css/style.css' rel = 'stylesheet'>
</head>

<body>

<?php
   $errEmail=$errTemp_password='';
   $email=$temp_password='';

   if(isset($_POST['submit'])){
    $email = $_POST['teacher_email'];
    $temp_password = $_POST['teacher_password'];

    if(empty($email)){
        $errEmail= "Email is Blank <br>";
    }
    // else {  
    //     $email = input_data($_POST["teacher_email"]);  
    //     // check that the e-mail address is well-formed  
    //     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
    //         $errEmail = "Invalid email format";  
    //     } }
    if(empty($temp_password)){
        $errTemp_password= "Password is Blank <br>";
    }

   }
   


?>
    <div class="login-page">
        <div class="form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
        <label for="name">Email:</label>
        <input type="text" name="teacher_email" id="email" value="<?php echo $email?>"><br>
        <span class="error"><?php echo $errEmail;?></span> <br>

        <label for="password">Password :</label>
        <input type="password" name="teacher_password" id="password" value="<?php echo $temp_password?>"> <br>
        <span class="error"><?php echo $errTemp_password;?></span> <br>
        <p class="message" style ='color :black; font-size:15px; margin-bottom:3px;' >Not registered? <a href="signin_teacher.php">Sign In</a></p>

        <!-- <input type="submit" value="submit" name="submit"> -->
        <button name = 'submit'> submit</submit>
    </form>
    </div>
        </div>
</body>

</html>
<?php
    if(isset($_POST['submit'])){
        $email = $_POST['teacher_email'];
        $temp_password = $_POST['teacher_password'];
        
        // $email = mysqli_real_escape_string($conn, $email);  
        // $password = mysqli_real_escape_string($conn, $password);  
        
        $sql = "SELECT teacher_id,teacher_name,teacher_password FROM `teachers`
                WHERE teacher_email = '$email'";  
        $result = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows == 1){  
            $row = mysqli_fetch_assoc($result);
            if(password_verify($temp_password,$row['teacher_password'])){
                $_SESSION['teacher_id']=$row['teacher_id'];
                $_SESSION['name'] = $row['teacher_name'];
                header("location:dashboard.php");
                
            }else{
                echo "password invalid";
            }
        }  
        else{  
                echo "<h1> Login failed. Invalid username or password.</h1>";
                // echo $count;  
            }
        mysqli_close($conn);     
        }    
?>
