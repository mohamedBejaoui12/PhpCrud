<?php
include "connect.php";

// Check if delete_id parameter is set
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Prepare and execute SQL to delete the record
    $sql_delete = "DELETE FROM std WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    if ($stmt_delete->execute([$delete_id])) {
        // Deletion successful
        echo "Record deleted successfully.";
    } else {
        // Deletion failed
        echo "Error deleting record: " . $stmt_delete->errorInfo()[2];
    }
    
    // Redirect back to the original page after deletion
    header("Location: aff.php"); // Make sure "aff.php" is the correct page
    exit();
} else {
    // If delete_id parameter is not set, redirect back to the original page
    header("Location: aff.php"); // Make sure "aff.php" is the correct page
    exit();
}
?>
