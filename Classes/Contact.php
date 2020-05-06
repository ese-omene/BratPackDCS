<?php
class Contact {
    // to get a full list of all the submitted forms
    public function listContact($dbcon){
        $sql = "SELECT * FROM contact";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $contacts = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $contacts;
    }
    //query to insert form data into database
    public function newContact($first_name, $last_name, $email, $phone_number, $message, $status, $dbcon){
        $sql = "INSERT INTO contact (first_name, last_name, email, phone_number, message, status ) VALUES (:first_name, :last_name, :email, :phone_number, :message, :status)";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':first_name', $first_name);
        $pdostm->bindParam(':last_name', $last_name);
        $pdostm->bindParam(':email', $email);
        $pdostm->bindParam(':phone_number', $phone_number);
        $pdostm->bindParam(':message', $message);
        $pdostm->bindParam(':status', $status);

        $insert = $pdostm->execute();
        return $insert;
    }
    // to get a specific form data
    public function getContactbyId($id, $dbcon){
        $sql = "SELECT * FROM contact WHERE id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);

        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }
    //query to update data in the database
    public function updateContact($id, $first_name, $last_name, $email, $phone_number, $message, $status, $dbcon){
        $sql = "UPDATE contact
                SET first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone_number = :phone_number,
                message = :message,
                status = :status
                WHERE id = :id
        
        ";

        $pst =   $dbcon->prepare($sql);

        $pst->bindParam(':first_name', $first_name);
        $pst->bindParam(':last_name', $last_name);
        $pst->bindParam(':email', $email);
        $pst->bindParam(':phone_number', $phone_number);
        $pst->bindParam(':message', $message);
        $pst->bindParam(':status', $status);
        $pst->bindParam(':id', $id);

        $updateC = $pst->execute();
        return $updateC;
    }
    // we grab the data the user inserted on the searchbar to look for that specific data in the database
    public function searchContact($contact__searchkey, $dbcon){
        $sql = "SELECT * FROM contact WHERE (first_name LIKE '%" . $contact__searchkey . "%') OR (last_name LIKE '%" . $contact__searchkey . "%')";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $searchContact = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $searchContact;
    }
    //to sort information depending on a value
    public function sortContactByStatus($contact__status, $dbcon){
        $sql = "SELECT * FROM contact WHERE status LIKE '%" . $contact__status . "%'";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $sortContact = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $sortContact;
    }
    // query to delete a specific entry from the database
    public function deleteContact($id, $dbcon){
        $sql = "DELETE FROM contact WHERE id = :id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

}