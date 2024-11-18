<?php
require_once(__DIR__ . '/Config/init.php');

$categoryController = new CategoryController();

// Retrieve all categories to display
$categories = $categoryController->index();

// Handle restoring all deleted categories
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreCategoryId"])) {
    $categoryController->restore($_POST["restoreCategoryId"]);
    header("Location: kategori.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f3e5f5, #cfd8dc);
            /* Soft gradient from light lavender to light grayish-blue */
        }

        .container {
            background: linear-gradient(145deg, #f9d5e5, #c3d9fc);
            /* Soft pastel pink to pastel blue gradient */
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            max-width: 850px;
            margin: auto;
            max-width: 1000px;
        }

        h1 {
            color: #4a7ebB;
            /* Calm pastel blue */
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .table {
            margin-top: 30px;
            /* Increase space above the table */
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
            table-layout: fixed;
            font-size: 1.1rem;
            /* Increase font size */
            /* Prevent table from expanding beyond container */
        }

        .table thead {
            background-color: #77a8d1;
            /* Pastel blue */
            color: white;
        }

        .table th,
        .table td {
            padding: 12px 12px;
            /* Decrease padding for smaller cells */
            /* Increase padding for larger table cells */
            text-align: center;
            word-wrap: break-word;
            /* Ensure long words don't cause overflow */
            overflow: hidden;
            /* Prevent content overflow */
            text-overflow: ellipsis;
            /* Add ellipsis for overflowed content */
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #fdfdff;
            /* Light pastel off-white for odd rows */
        }

        .table-striped tbody tr:nth-child(even) {
            background-color: #eff2f9;
            /* Very light pastel blue for even rows */
        }

        .table td {
            vertical-align: middle;
        }

        .table tr:hover {
            background-color: #d7e6fc;
            /* Light pastel hover effect */
        }

        .btn {
            font-size: 0.875rem;
            padding: 10px 18px;
            border-radius: 6px;
            transition: all 0.3s ease;
            margin-right: 12px;
        }

        .btn-primary {
            background-color: #9ec8f4;
            /* Soft pastel sky blue */
            border-color: #9ec8f4;
        }

        .btn-danger {
            background-color: #ff7f7f;
            /* Soft pastel red with a lighter tone for a more subtle look */
            border-color: #ff7f7f;
        }

        .btn-danger:hover {
            background-color: #ff5f5f;
            /* Lighter red with a more vibrant feel on hover */
            border-color: #ff5f5f;
        }

        .btn-warning {
            background-color: #ffcc80;
            /* Light pastel orange for a gentle look */
            border-color: #ffcc80;
        }

        .btn-warning:hover {
            background-color: #ffb74d;
            /* Slightly deeper orange for hover */
            border-color: #ffb74d;
        }

        .btn-info {
            background-color: #7ed6d0;
            /* Soft pastel teal */
            border-color: #7ed6d0;
        }

        .btn:hover {
            opacity: 0.85;
            transform: translateY(-2px);
        }

        .d-flex {
            justify-content: flex-start;
        }

        .mb-3 {
            margin-bottom: 25px;
        }

        .mx-3 {
            margin-left: 15px;
            margin-right: 15px;
        }

        .card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card a {
            text-decoration: none;
        }

        .alert {
            background-color: #ffe2e2;
            /* Light red for alerts */
            color: #a94442;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .btn-info:hover {
            background-color: #4c8f8f;
            /* Darker mint green on hover */
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <h1>Category List</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="View/Category/create_category.php" class="btn btn-primary">Add Category</a>
            <a href="index.php" class="btn btn-danger mx-3">Back to Cake</a>
        </div>

        <?php if (!empty($categories)): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($category['id']); ?></td>
                            <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                            <td>
                                <a href="View/Category/update_category.php?id=<?php echo $category['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                                <a href="View/Category/delete_category.php?id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert" role="alert">
                No categories found!
            </div>
        <?php endif; ?>

        <!-- Restore form should only be shown if categories exist -->
        <?php if (!empty($categories)): ?>
            <form method="POST">
                <input type="hidden" name="restoreCategoryId" value="<?php echo $categories[0]['id']; ?>"> <!-- Use the first category ID as an example -->
                <button type="submit" class="btn btn-info">Restore</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>