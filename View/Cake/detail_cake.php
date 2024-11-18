<?php
include(__DIR__ . '/../../Config/init.php');

$cakeController = new CakeController();
$cakeDetails = [];

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $cakeDetails = $cakeController->show($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Views</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FCE6C3, #D6A8FF);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* min-height: 100vh; */
            display: flex;
            margin-top: 30px;
            /* justify-content: center; */
            /* align-items: center; */
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            /* Increased container width for better table space */
            max-width: 900px;
            /* Max width to prevent over-expansion */
            margin-top: 50px;
        }

        h2 {
            color: #004ba0;
            margin-bottom: 20px;
            text-align: left;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            table-layout: fixed;
            /* Ensures the table takes full width */
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #004ba0;
            color: white;
            font-weight: bold;
        }

        .table td {
            background-color: #f1f8ff;
            color: #333;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #e0f7fa;
        }

        .table tbody tr:hover {
            background-color: #b3e5fc;
        }

        .btn-secondary {
            background-color: #7f8c8d;
            border-color: #7f8c8d;
        }

        .btn-secondary:hover {
            background-color: #95a5a6;
            border-color: #95a5a6;
        }

        .back-button {
            margin-top: 20px;
            display: block;
            width: 100%;
            text-align: left;
        }
    </style>
</head>

<body>
    <div>
        <?php if (!empty($cakeDetails)): ?>
            <h2>Cake Views</h2>
            <table class="table table-bordered w-50">
                <tr>
                    <th>ID</th>
                    <td><?php echo htmlspecialchars($cakeDetails['id']); ?></td>
                </tr>
                <tr>
                    <th>Cake Name</th>
                    <td><?php echo htmlspecialchars($cakeDetails['cake_name']); ?></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td><?php echo htmlspecialchars($cakeDetails['category_id']); ?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?php echo htmlspecialchars($cakeDetails['price']); ?></td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td><?php echo htmlspecialchars($cakeDetails['stock']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Cake not found!</p>
        <?php endif; ?>
        <a href="../../index.php" class="btn btn-secondary mb-3">Back to Cake</a>
    </div>
</body>

</html>