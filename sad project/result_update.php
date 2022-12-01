<?php
   include("config.php");
   session_start();
?>

<?php
$id = $_SESSION['teacher_id'];
$student_id=$_SESSION['student_id'];
if(isset($_POST['submit']))
{
    $subject=$_POST['subject'];
    $percentage=$_POST['percentage'];
    $terminal=$_POST['is_terminal'];
    $display=$_POST['display_result'];
    if($terminal=="yes")
    {
        $is_terminal=1;
    }
    else
    {
        $is_terminal=0;
    }
    if($display=="yes")
    {
        $display_result=1;
    }
    else
    {
        $display_result=0;
    }
    
    if($percentage>=80)
    {
        $grade="A";
    }
    elseif($percentage>=60&&$percentage<80)
    {
        $grade="B";
    }
    elseif($percentage>=50&&$percentage<60)
    {
        $grade="C";
    }
    elseif($percentage>=40&&$percentage<50)
    {
        $grade="D";
    }
    else
    {
        $grade="F";
    }
    $sql = "UPDATE results 
    SET result_percentage ='".$percentage."',is_terminal ='".$is_terminal."', result_grade ='".$grade."', display_result ='".$display_result."', subject_id ='".$subject."'
    WHERE result_id ='".$_SESSION['result_id']."'";

if(mysqli_query($conn,$sql)){
    echo "Sucess";
}
else{
    echo "unsucess".mysqli_error($conn);
}
}
?>