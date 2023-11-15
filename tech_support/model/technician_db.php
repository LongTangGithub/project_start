<?php

function get_technicians() {
    global $db;
    $query = 'SELECT * FROM technicians
              ORDER BY lastName';
    
    $statement = $db->prepare($query);
    $statement->execute();
    $technicians = $statement->fetchAll();
    $statement-> closeCursor();
    return $technicians;
    
}

function delete_technician($technician_id){
    global $db;
    $query = 'DELETE FROM technicians
              WHERE techID = :technician_id';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':technician_id', $technician_id);
    $statement->execute();
    $statement-> closeCursor();
    
}

function add_technician($technician_id, $first_name, $last_name, $email, $phone, $password) {
    global $db;
    $query = 'INSERT INTO technicians
                 (techID, firstName, lastName, email, phone, password)
              VALUES
                 (:technician_id, :first_name, :last_name, :email, :phone, :password)';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':technician_id', $technician_id);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
    
}

function get_technician_by_email($email){
    global $db;
    $query = 'SELECT * FROM technicians ' .
             'WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $technician = $statement->fetch();
    $statement->closeCursor();
    return $technician;
}
?>