<?php
include(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$errors = [];

// Get the category ID from the URL and retrieve category details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $categoryDetails = $categoryController->show($id);
    $category_name = $categoryDetails['category_name'] ?? '';
}

// Handle form submission for updating the category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate category_name
    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category Name is required";
    } else {
        $category_name = $_POST["category_name"];
    }

    // If there are no validation errors, proceed with updating the category
    if (empty($errors)) {
        $data = ['category_name' => $category_name];

        if ($categoryController->update($id, $data)) {
            header("Location: ../../kategori.php");
            exit();
        } else {
            echo "Error updating category.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Body background */
        body {
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
            /* Soft pink to light blue */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Container for the form */
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            /* Limit the width */
            margin-top: 50px;
        }

        /* Heading style */
        h1 {
            color: #004ba0;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        /* Form spacing */
        .mb-3 {
            margin-bottom: 20px;
        }

        /* Input and label styling */
        label {
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
        }

        /* Input focus effect */
        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }

        /* Text for errors */
        .text-danger {
            font-size: 0.875rem;
            color: #d9534f;
        }

        /* Button container for alignment */
        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        /* Primary button */
        /* Primary button */
        .btn-primary {
            background-color: #3498db;
            /* Lively blue */
            border-color: #3498db;
            padding: 12px 20px;
            font-size: 1rem;
            flex: 1;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(52, 152, 219, 0.3);
            /* Subtle shadow */
            transition: all 0.3s ease-in-out;
        }

        /* Primary button hover effect */
        .btn-primary:hover {
            background-color: #2980b9;
            /* Darker blue for hover */
            border-color: #2980b9;
            box-shadow: 0 6px 10px rgba(52, 152, 219, 0.4);
            /* Darker shadow on hover */
        }

        /* Secondary button */
        .btn-secondary {
            background-color: #95a5a6;
            /* Soft grey-blue */
            border-color: #95a5a6;
            padding: 12px 20px;
            font-size: 1rem;
            flex: 1;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(149, 165, 166, 0.3);
            /* Subtle shadow */
            transition: all 0.3s ease-in-out;
        }

        /* Secondary button hover effect */
        .btn-secondary:hover {
            background-color: #7f8c8d;
            /* Darker grey-blue for hover */
            border-color: #7f8c8d;
            box-shadow: 0 6px 10px rgba(149, 165, 166, 0.4);
            /* Darker shadow on hover */
        }

        a.btn-secondary {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1>Update Category</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="category_name" value="<?php echo htmlspecialchars($category_name); ?>">
                <?php if (isset($errors['category_name'])): ?>
                    <div class="text-danger"><?php echo $errors['category_name']; ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
            <a href="../../kategori.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>