<?php
    include 'pdo.php';

    $categoryID = filter_input(type: INPUT_GET, variable_name:'categoryID');
    if (empty($categoryID)) {
        $categoryID = 1;
    }

    try {
        $query = 'SELECT * FROM products';
        $statement = $db->prepare($query);
        $statement->execute();
        $products = $statement->fetchAll();
        $statement->closeCursor();

        $cat_query = 'SELECT * FROM categories';
        $cat_statement = $db->prepare($cat_query);
        $cat_statement->execute();
        $categories = $cat_statement->fetchAll();
        $cat_statement->closeCursor();
    } catch (Exception $error) {
        $error_message = $error->getMessage();
        echo "Error Running SQL Query: $error_message";
    }

?>

<h1>PDO Demo</h1>

<form method="index.php" method="get">
    <select name="categoryID">
        <?php foreach ($categories as $category) : ?>
        <option value="<?php echo $category['categoryID']; ?>">
                <?php if ($categoryID === $category['categoryID']) echo 'selected'; ?>
            <?php echo $category['categoryID']; ?>
        </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Filter">
</form>

<table border="1">
    <tr>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>List Price</th>
    </tr>
    <?php foreach ($products as $product) : ?>
    <tr>
        <td><?php echo $product['productCode']; ?></td>
        <td><?php echo $product['productName']; ?></td>
        <td><?php echo $product['listPrice']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Add Product</h2>

<form action="add_product.php" method="post">
    <input type="hidden" name="categoryID" value="<?php echo $categoryID; ?>">

    <label for="productCode">Product Code</label><br>
    <input text="text" name="productCode"><br>

    <label for="productCode">Product Code</label><br>
    <input text="text" name="productCode"><br>

    <label for="productCode">Product Code</label><br>
    <input text="text" name="productCode"><br>

    <label for="productCode">Product Code</label><br>
    <input text="text" name="productCode"><br>
</form>
