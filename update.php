<?php
include "connect.php";

// Check if update_id parameter is set
if(isset($_GET['update_id'])) {
    $update_id = $_GET['update_id'];
    
    // Fetch the record based on update_id
    $sql_select = "SELECT * FROM std WHERE id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->execute([$update_id]);
    $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
    
    // Check if form is submitted for updating
    if(isset($_POST['update'])) {
        // Retrieve form data
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        // Update the record in the database
        $sql_update = "UPDATE std SET name=?, age=?, email=?, password=? WHERE id=?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([$name, $age, $email, $password, $update_id]);
        
        // Redirect back to the original page after updating
        header("Location: aff.php"); // Replace "original_page.php" with the correct page
        exit();
    }
    
    // Display the update form with existing values pre-filled
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update User</title>
    </head>
    <body>
        <h2>Update User</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br><br>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" value="<?php echo $row['age']; ?>"><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>"><br><br>
            <input type="submit" name="update" value="Update">
        </form>
    </body>
    </html>
    <?php
    exit();
} else {
    // If update_id parameter is not set, redirect back to the original page
    header("Location: aff.php"); // Replace "original_page.php" with the correct page
    exit();
}
?>
