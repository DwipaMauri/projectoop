<?php
include(__DIR__ . '/../../Config/init.php');

$cakeController = new CakeController();
$categoryController = new CategoryController();
$errors = [];

$id = $_GET['id'];
// Get the product ID from the URL and retrieve product details
if (isset($_GET['id'])) {

    $cakeDetails = $cakeController->show($id);
    // var_dump($cakeDetails);
    if (!$cakeDetails) {
        die("Cake not found.");
    }
    $cake_name = $cakeDetails['cake_name'] ?? '';
    $category_id = $cakeDetails['category_id'] ?? '';
    $price = $cakeDetails['price'] ?? '';
    $stock = $cakeDetails['stock'] ?? ''; // Ensure stock is retrieved
}

// Retrieve all categories for the category dropdown
$categories = $categoryController->index();

// Handle form submission for updating the product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate product fields
    if (empty($_POST["cake_name"])) {
        $errors['cake_name'] = "Cake Name is required";
    } else {
        $cake_name = $_POST["cake_name"];
    }

    if (empty($_POST["category_id"])) {
        $errors['category_id'] = "Category is required";
    } else {
        $category_id = $_POST["category_id"];
    }

    if (empty($_POST["price"]) || !is_numeric($_POST["price"])) {
        $errors['price'] = "Valid Price is required";
    } else {
        $price = $_POST["price"];
    }

    if (empty($_POST["stock"]) || !is_numeric($_POST["stock"])) {
        $errors['stock'] = "Valid Stock is required";
    } else {
        $stock = $_POST["stock"];
    }

    // If there are no validation errors, proceed with updating the product
    if (empty($errors)) {
        $data = [
            'cake_name' => $cake_name,
            'category_id' => $category_id,
            'price' => $price,
            'stock' => $stock
        ];

        if ($cakeController->update($id, $data)) {
            header("Location: ../../index.php");
            exit();
        } else {
            echo "Error updating cake.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cake</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FCE6C3, #D6A8FF);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
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

        h1 {
            color: #004ba0;
            text-align: center;
            margin-bottom: 30px;
            /* Space between the title and the form */
        }

        form {
            margin-top: 20px;
        }

        .mb-3 {
            margin-bottom: 20px;
            /* Increased space between form fields */
        }

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

        .form-control:focus {
            border-color: #004ba0;
        }

        .form-select {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
        }

        .form-select:focus {
            border-color: #004ba0;
        }

        .text-danger {
            font-size: 0.875rem;
            color: #d9534f;
        }

        button {
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #004ba0;
            border-color: #004ba0;
            flex: 1;
            /* Make button take available space */
        }

        .btn-primary:hover {
            background-color: #003366;
            border-color: #003366;
        }

        .btn-secondary {
            background-color: #7f8c8d;
            border-color: #7f8c8d;
            flex: 1;
            /* Make button take available space */
        }

        .btn-secondary:hover {
            background-color: #95a5a6;
            border-color: #95a5a6;
        }

        a.btn-secondary {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1>Update Cake</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="cake_name" class="form-label">Cake Name</label>
                <input type="text" name="cake_name" class="form-control" id="cake_name" value="<?php echo htmlspecialchars($cake_name); ?>">
                <?php if (isset($errors['cake_name'])): ?>
                    <div class="text-danger"><?php echo $errors['cake_name']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" class="form-select" id="category_id">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo (isset($category_id) && $category_id == $category['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['category_id'])): ?>
                    <div class="text-danger"><?php echo $errors['category_id']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" class="form-control" id="price" value="<?php echo htmlspecialchars($price); ?>">
                <?php if (isset($errors['price'])): ?>
                    <div class="text-danger"><?php echo $errors['price']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock" value="<?php echo htmlspecialchars($stock); ?>">
                <?php if (isset($errors['stock'])): ?>
                    <div class="text-danger"><?php echo $errors['stock']; ?></div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 0px;">Update Cake</button>
            <a href="../../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>