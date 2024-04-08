<?php
include 'connect.php'; // Assuming this file contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass']; // Corrected parameter name
    $age=$_POST['age'];

    $sql = "INSERT INTO std (name, age, email, password) VALUES (:username, :age, :email, :password)"; // Corrected placeholder

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password); // Corrected parameter name
    $stmt->bindParam(':age', $age);

    try {
        $stmt->execute();
        header('location:aff.php');
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>
    <h2>Add User</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="age">Age:</label><br> <!-- Corrected label -->
        <input type="number" id="age" name="age" required><br><br>
       
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="pass">Password:</label><br> <!-- Corrected label -->
        <input type="password" id="pass" name="pass" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
