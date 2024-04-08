<?php
include "connect.php";

// Pagination variables
$limit = 4; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number
$start = ($page - 1) * $limit; // Starting row number for the query

// Query to fetch limited records
$sql = "SELECT * FROM std LIMIT $start, $limit";
$stmt = $conn->query($sql);

// Count total number of records
$total_records = $conn->query("SELECT count(*) as total FROM std")->fetch()['total'];
$total_pages = ceil($total_records / $limit); // Calculate total pages

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>User Data</h2>

    <a href="addUser.php"><button>Add User</button></a>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Age</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><a href="delete.php?delete_id=<?php echo $row['id']; ?>"><button>Delete</button></a>
                <a href="update.php?update_id=<?php echo $row['id']; ?>"><button>Update</button></a></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div>
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo ($page - 1); ?>">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" <?php if ($page == $i) echo 'style="font-weight:bold"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo ($page + 1); ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>
