<?php

require('../model/database.php');
require('../model/incident_db.php');
require('../model/customer_db.php');
require('../model/product_db.php');


$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'display_incidents';
    }
}
if ($action == 'get_customer'){
    include('get_customer.php');
}

// Create incident report
else if ($action == 'create_incident') {
    $email = filter_input(INPUT_POST, 'email');
    if ($email == NULL || $email == FALSE) {
        $error = "Invalid email. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        $products = get_customer_products($email);
        include('create_incident.php');
    }
}

// Add incident report
else if ($action == 'add_incident') {
    $customerid = filter_input(INPUT_POST, 'customerID', FILTER_VALIDATE_INT);
    $productcode = filter_input(INPUT_POST, 'product_list');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');

    if ($customerid == NULL || $customerid === FALSE ||
        $productcode == NULL || $productcode === FALSE ||
        $title == NULL || $title === FALSE ||
        $description == NULL || $description === FALSE) {
            $error = "Incident report is missing information. Please input all fields.";
            include('../errors/error.php');
    } else {
        create_incident($customerid, $productcode, $title, $description);
        include('incident_success.php');
    }
}
?>