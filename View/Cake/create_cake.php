<?php
require(__DIR__ . '/../../Config/init.php');

$cakeController = new CakeController();
$categoryController = new CategoryController();
$errors = [];

// Retrieve all categories for the category dropdown
$categories = $categoryController->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // If there are no validation errors, proceed with creating the product
    if (empty($errors)) {
        $data = [
            'cake_name' => $cake_name,
            'category_id' => $category_id,
            'price' => $price,
            'stock' => $stock
        ];

        if ($cakeController->create($data)) {
            echo "<script>alert('Cake added successfully!')</script>";
            header("Location: ../../index.php");
            exit();
        } else {
            echo "<script>alert('Failed to add cake!')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Cake</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #A8E6CF, #D6A8FF);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
        }

        .form-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
            color: #393e46;
            font-size: 1.5em;
        }

        .btn-primary {
            background-color: #FF7043;
            border-color: #FF7043;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #FF5722;
            border-color: #FF5722;
        }

        .btn-secondary {
            background-color: #6A1B9A;
            border-color: #6A1B9A;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #8E24AA;
            border-color: #8E24AA;
        }

        .text-danger {
            font-size: 0.9em;
            color: #d32f2f;
            margin-top: 10px;
        }

        label {
            font-weight: bold;
            color: #393e46;
            font-size: 1.1em;
        }

        .form-control {
            border-radius: 10px;
            padding: 8px 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 1em;
        }

        .form-control:focus {
            border-color: #FF7043;
            box-shadow: 0 0 5px rgba(255, 112, 67, 0.5);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn-group .btn {
            width: 48%;
        }

        .footer-text {
            text-align: center;
            font-size: 0.8em;
            color: #6c757d;
            margin-top: 20px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1 class="form-title">Create Cake</h1>

            <form method="POST">
                <div class="mb-3">
                    <label for="cake_name" class="form-label">Cake Name</label>
                    <input type="text" name="cake_name" class="form-control" id="cake_name"
                        value="<?php echo htmlspecialchars($cake_name ?? ''); ?>">
                    <?php if (isset($errors['cake_name'])): ?>
                        <div class="text-danger"><?php echo $errors['cake_name']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-select" id="category_id">
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"
                                <?php echo (isset($category_name) && $category_name == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['category_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['category_name'])): ?>
                        <div class="text-danger"><?php echo $errors['category_name']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" name="price" class="form-control" id="price"
                        value="<?php echo htmlspecialchars($price ?? ''); ?>">
                    <?php if (isset($errors['price'])): ?>
                        <div class="text-danger"><?php echo $errors['price']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" id="stock"
                        value="<?php echo htmlspecialchars($stock ?? ''); ?>">
                    <?php if (isset($errors['stock'])): ?>
                        <div class="text-danger"><?php echo $errors['stock']; ?></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary w-100">Create Cake</button>
                <a href="../../index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
            </form>
        </div>
    </div>
</body>

</html>