<?php
require(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$errors = [];
$category_name = ''; // Initialize variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate category_name
    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category Name is required";
    } else {
        $category_name = trim($_POST["category_name"]); // Trim whitespace
    }

    // If there are no validation errors, proceed with creating the category
    if (empty($errors)) {
        // Prepare data for insertion
        $data = [
            'category_name' => $category_name,
            'isDeleted' => 0 // Set isDeleted to 0 (active)
        ];

        if ($categoryController->create($data)) {
            header("Location: ../../kategori.php");
            exit();
        } else {
            error_log("Failed to add category: " . print_r($data, true));
            $errors['database'] = "Failed to add category! Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f0f4f8;
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 600px;
        margin-top: 50px;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 2em;
        color: #4a4e69;
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .form-label {
        font-weight: bold;
        color: #4a4e69;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 1.1em;
        background-color: #f7f7f7;
    }

    .form-control:focus {
        border-color: #6c5b7b;
        box-shadow: 0 0 8px rgba(108, 91, 123, 0.5);
    }

    .mb-3 {
        margin-bottom: 20px;
    }

    .text-danger {
        font-size: 0.9em;
        margin-top: 5px;
        color: #e74c3c;
    }

    .btn-primary {
        background-color: #6c5b7b;
        border: none;
        border-radius: 5px;
        padding: 12px 20px;
        font-size: 1.1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #8e7f9e;
    }

    .btn-secondary {
        background-color: #b4a7d6;
        border: none;
        border-radius: 5px;
        padding: 12px 20px;
        font-size: 1.1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #9b8cb6;
    }

    .btn {
        width: 100%;
        margin-top: 10px;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Create Category</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="category_name" value="<?php echo htmlspecialchars($category_name); ?>">
                <?php if (isset($errors['category_name'])): ?>
                    <div class="text-danger"><?php echo $errors['category_name']; ?></div>
                <?php endif; ?>
                <?php if (isset($errors['database'])): ?>
                    <div class="text-danger"><?php echo $errors['database']; ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="../../Kategori.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>