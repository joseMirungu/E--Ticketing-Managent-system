<?php
require ('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Africa/Nairobi');
    $Location = $_POST["location"];
    $Description = $_POST["problemDescription"];
    $Priority = $_POST["priority"];
    $Deadline = $_POST["deadline"];
    $timeStart = date('Y-m-d H:i:s');
    $Department = $_POST["department"];
    $updateQuery = "INSERT INTO complaints (Location, Description, Priority, Deadline, Timestart, Department) values ('$Location', '$Description', '$Priority', '$Deadline', '$timeStart', '$Department')";
          if(mysqli_query($conn, $updateQuery)){
        // echo "<script>alert('Assigned successfully')
        // window.location.href = '../index.php#D2';
         //</script>";
         //echo $updateQuery;

        }
        else{
        echo "Error assigning: " . mysqli_error($conn);
        echo $updateQuery;
        }
}
?>
