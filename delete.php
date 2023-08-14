<?php
include('db_connect.php');

if(isset($_POST['action']) && isset($_POST['member_id'])){
    $action = $_POST['action'];
    $memberId = $_POST['member_id'];

    if($action == 'delete'){
        // Perform the delete operation
        $updateQuery = "UPDATE usertable SET status = 'Inactive' WHERE id = '$memberId'";
        if($conn->query($updateQuery) === TRUE){
            echo 1; // Return success status
        } else {
            echo 0; // Return error status
        }
    } elseif($action == 'reactivate'){
        // Perform the reactivate operation
        $updateQuery = "UPDATE usertable SET status = 'Active' WHERE id = '$memberId'";
        if($conn->query($updateQuery) === TRUE){
            echo 1; // Return success status
        } else {
            echo 0; // Return error status
        }
    }
}
