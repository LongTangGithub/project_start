<?php

function get_customer_products($email) {
    global $db;
    $query = 'SELECT c.customerID, c.firstName, c.lastName, c.email, p.productCode, p.name, p.version  
    FROM customers c INNER JOIN registrations r ON c.customerID=r.customerID INNER JOIN products p ON r.productCode=p.productCode WHERE c.email = :email ';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $custproducts = $statement->fetchAll();
    $statement->closeCursor();
    return $custproducts;
}

function create_incident($cid, $procode, $title, $descr) {
    global $db;
    $dt = date('Y-m-d H:i:s');
    $query = 'INSERT INTO incidents (incidentID, customerID, productCode, techID, dateOpened, dateClosed, title, description) VALUES (NULL, :cid, :procode, NULL, :dt, NULL, :title, :descr)';
    $statement = $db->prepare($query);
    $statement->bindValue(':cid', $cid);
    $statement->bindValue(':procode', $procode);
    $statement->bindValue(':dt', $dt);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':descr', $descr);
    $statement->execute();
    $statement->closeCursor();
}

?>