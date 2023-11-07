<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>

    <!-- display a table of products -->
    <table>
        <tr>
            <th scope="col">Code</th>
            <th scope="col">Name</th>
            <th scope="col">Version</th>
            <th scope="col">Release Date</th>
            <th scope="col">&nbsp;</th>
        </tr>
        <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo htmlspecialchars($product['productCode']); ?></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['version']); ?></td>
            <!-- Format and display the release date -->
            <td><?php 
                $date = new DateTime($product['releaseDate']);
                echo htmlspecialchars($date->format('n-j-Y')); // formats date as M-D-YYYY without leading zeros
            ?></td>
            <td><form action="." method="post">
                <input type="hidden" name="action"
                       value="delete_product">
                <input type="hidden" name="product_code"
                       value="<?php echo htmlspecialchars($product['productCode']); ?>">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
            </form></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_form">Add Product</a></p>

</main>
<?php include '../view/footer.php'; ?>
