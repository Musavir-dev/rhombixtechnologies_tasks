<?php

include "dbconnection.php";

$obj = new DBconnection();

$product = null;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM products WHERE ID = $id";
    $result = $obj->find($sql);;

    if ($result) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = intval($_POST['status']);

    $sql = "UPDATE products     SET Name = '$name', Price = '$price', Description = '$description', Status = $status WHERE ID = $id";

    if ($obj->update($sql)) {
        echo "Product updated successfully";

        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $obj->conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container py-5">
        <?php if ($product): ?>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo $product['Name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price"
                        value="<?php echo $product['Price']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"
                        required><?php echo $product['Description']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status" required>
                        <option value="1" <?php if ($product['Status'] == 1)
                            echo 'selected'; ?>>Active</option>
                        <option value="2" <?php if ($product['Status'] == 2)
                            echo 'selected'; ?>>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
            </form>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>