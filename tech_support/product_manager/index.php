<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products':
        // Get product data
        $products = get_products();

        // Display the product list
        include('product_list.php');
        break;
    
    case 'delete_product':
        $product_code = filter_input(INPUT_POST, 'product_code');
        delete_product($product_code);
        header("Location: .");
        break;
    
    case 'show_add_form':
        include('product_add.php');
        break;
    
    case 'add_product':
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
        $release_date_input = filter_input(INPUT_POST, 'release_date');

        // Convert the date to a timestamp
        $release_date_timestamp = strtotime($release_date_input);

        // Validate the inputs
        if (empty($code) || empty($name) || empty($version) || $version === FALSE || $release_date_timestamp === FALSE ) {
            $error = "Invalid product data. Check all fields and try again.";
            include('../errors/error.php');
        } else {
            // Format the release date for storage
            $release_date = date('Y-m-d', $release_date_timestamp);   // formats date as MM-DD-YYYY for storage

            add_product($code, $name, $version, $release_date);
            header("Location: .");
        }
        break;
    
    default:
        $error = "Unknown action: " . $action;
        include('../errors/error.php');
        break;
}
?>
