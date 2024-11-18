<?php
include(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$categoryDetails = [];

// Get the category ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryDetails = $categoryController->show($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Views</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container">
    <a href="../kategori.php" class="btn btn-secondary mb-3">Back to Category</a>

    <?php if (!empty($categoryDetails)): ?>
        <h2>Category Views</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($categoryDetails['id']); ?></td>
            </tr>
            <tr>
                <th>Category Name</th>
                <td><?php echo htmlspecialchars($categoryDetails['category_name']); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>Category not found!</p>
    <?php endif; ?>
</body>

</html>