<?php


class Parents
{
    public function addParent($dbcon, $fname, $lname, $address, $email, $phone)
    {
        //insert data
        $sql = 'INSERT INTO parents (first_name, last_name, address, email, phone) VALUES (:fname, :lname, :address, :email, :phone)';
        $pdostm = $dbcon->prepare($sql);
        //$pst->bindParam(':id', $id);
        $pdostm->bindParam(':fname', $fname);
        $pdostm->bindParam(':lname', $lname);
        $pdostm->bindParam(':address', $address);
        $pdostm->bindParam(':email', $email);
        $pdostm->bindParam(':phone', $phone);
        //execute SQL and return the result
        $count = $pdostm->execute();
        return $count;

    }
    public function viewParents($dbcon)
    {
        //select all messages
        $sql = 'SELECT * FROM parents';
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $topics = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $topics;
    }

}