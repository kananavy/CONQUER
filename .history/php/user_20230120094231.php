<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $msg = 
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} OR msg_id = {$msg} ORDER BY unique_id ASC ");
    $output = "";
// Active user Online
    if(mysqli_num_rows($sql) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($sql) > 0){
    include_once "data.php";
        }
echo "$output";
?>