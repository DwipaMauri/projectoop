<?php
require_once(__DIR__ . '/Config/init.php');

$cakeController = new CakeController();
$categoryController = new CategoryController();

// Retrieve all cakes to display
$cakes = $cakeController->index(); // Use the index() method to get all cakes

// Retrieve all categories to create a mapping of category IDs to names
$categories = $categoryController->index(); // Use the index() method to get all categories
$categoryMap = [];
foreach ($categories as $category) {
    $categoryMap[$category['id']] = $category['category_name'];
}

// Handle restoring deleted cakes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreCakeId"])) {
    $cakeController->restore($_POST["restoreCakeId"]); // Use the restore() method
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #A8E6CF, #D6A8FF);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            margin-top: 50px;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #003c8f;
            margin-bottom: 20px;
        }

        .table {
            margin-top: 20px;
            table-layout: fixed;
            /* Ensures columns are adjusted to fit the content */
        }

        .table th,
        .table td {
            text-align: center;
            /* Center-align the table content */
            vertical-align: middle;
        }

        .table thead {
            background-color: #004ba0;
            color: white;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #e0f7fa;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f1f8ff;
        }

        .table tbody tr:hover {
            background-color: #b3e5fc;
        }

        .btn {
            font-size: 0.875rem;
            padding: 6px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #ff7043;
            border-color: #ff7043;
        }

        .btn-primary:hover {
            background-color: #ff8a65;
        }

        .btn-warning {
            background-color: #ffee58;
            border-color: #ffee58;
        }

        .btn-warning:hover {
            background-color: #fff176;
        }

        .btn-danger {
            background-color: #f44336;
            border-color: #f44336;
        }

        .btn-danger:hover {
            background-color: #ef5350;
        }

        .btn-secondary {
            background-color: #ab47bc;
            border-color: #ab47bc;
        }

        .btn-secondary:hover {
            background-color: #ba68c8;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .action-buttons .btn {
            min-width: 60px;
            /* Adjust button width */
        }

        .empty-message {
            background-color: #fff3e0;
            color: #5d4037;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-top: 20px;
        }

        .btn-view-category {
            background-color: #9c80b6;
            /* Soft lavender with a calming tone */
            border-color: #9c80b6;
            color: #ffffff;
            /* White text for contrast */
        }

        /* Hover Effect */
        .btn-view-category:hover {
            background-color: #7a5a92;
            /* Slightly darker lavender on hover */
            border-color: #7a5a92;
        }

        /* General Button Styling */
        .btn-view-category {
            font-size: 0.875rem;
            padding: 10px 18px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Create Cake</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="View/Cake/create_cake.php" class="btn btn-primary me-3">Add Cake</a>
            <a href="kategori.php" class="btn btn-view-category">View Categories</a>
        </div>

        <?php if (!empty($cakes)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cake Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cakes as $cake): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cake['id']); ?></td>
                            <td><?php echo htmlspecialchars($cake['cake_name']); ?></td>
                            <td><?php echo htmlspecialchars($categoryMap[$cake['category_id']] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($cake['price']); ?></td>
                            <td><?php echo htmlspecialchars($cake['stock']); ?></td>
                            <td class="action-buttons">
                                <a href="View/Cake/detail_cake.php?id=<?php echo $cake['id']; ?>" class="btn btn-warning btn-sm">View</a>
                                <a href="View/Cake/update_cake.php?id=<?php echo $cake['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="View/Cake/delete_cake.php?id=<?php echo $cake['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No cakes found!</p>
        <?php endif; ?>

        <!-- Assuming you want to restore a specific cake, this form should be inside the loop or handled differently -->
        <form method="POST">
            <input type="hidden" name="restoreCakeId" value="<?php echo $cake['id']; ?>">
            <button type="submit" class="btn btn-secondary">Restore</button>
        </form>
    </div>
</body>

</html>