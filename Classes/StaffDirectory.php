<?php

class StaffDirectory{

    public function liststaff($dbcon, $staff__searchkey, $public__jobtitle){

        $sql = "SELECT * FROM staff_directory";
        $sql__order = " ORDER BY firstname";

        if($staff__searchkey != ""){
            // Update the the query to include search:
            $sql__search = " WHERE LOWER(firstname) LIKE LOWER('%" . $staff__searchkey . "%') OR LOWER(lastname) LIKE LOWER('%" . $staff__searchkey . "%') ORDER BY firstname";
            $sql = $sql . $sql__search;
            // print_r($sql);
        } else if ($public__jobtitle != "") {
            $sql__jobsearch = " WHERE LOWER(jobtitle) LIKE LOWER('%" . $public__jobtitle . "%') ORDER BY firstname";
            $sql = $sql . $sql__jobsearch;
        }else {
            $sql = $sql . $sql__order;
        }

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $staffmembers = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $staffmembers;

    }


    public function addstaff($dbcon, $addstaff__firstname, $addstaff__lastname, $addstaff__email, $addstaff__phone, $addstaff__jobtitle, $addstaff__photo){
        $sql = "INSERT INTO staff_directory (firstname, lastname, email, phone, jobtitle, photo ) VALUES (:firstname, :lastname, :email, :phone, :jobtitle, :photo) ";
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':firstname', $addstaff__firstname);
        $pst->bindParam(':lastname', $addstaff__lastname);
        $pst->bindParam(':email', $addstaff__email);
        $pst->bindParam(':phone', $addstaff__phone);
        $pst->bindParam(':jobtitle', $addstaff__jobtitle);
        $pst->bindParam(':photo', $addstaff__photo);

        $count = $pst->execute();
        if($count){
            header("Location: staffdirectory_list.php?addsuccess=yes");
            return $count;
        } else {
            echo "Problem adding new staff member.";
        }
    }




    public function getStaffById($staffID, $dbcon){
        $sql = "SELECT * FROM staff_directory WHERE staffID = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $staffID);

        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }

    public function updateStaff($staffID, $staff__firstname, $staff__lastname, $staff__email, $staff__phone, $staff__jobtitle, $staff__photo, $dbcon)
    {

        if ($staff__photo != ""){
            $sql = "UPDATE staff_directory
                SET firstname = :firstname,
                lastname = :lastname,
                email = :email,
                phone = :phone,
                jobtitle = :jobtitle,
                photo = :photo
                WHERE staffID = :staffID
        ";
        } else {
            $sql = "UPDATE staff_directory
                SET firstname = :firstname,
                lastname = :lastname,
                email = :email,
                phone = :phone,
                jobtitle = :jobtitle
                WHERE staffID = :staffID
        ";
        }


        $pst = $dbcon->prepare($sql);

        if($staff__photo != ""){
            $pst->bindParam(':photo', $staff__photo);
        }

        $pst->bindParam(':firstname', $staff__firstname);
        $pst->bindParam(':lastname', $staff__lastname);
        $pst->bindParam(':email', $staff__email);
        $pst->bindParam(':phone', $staff__phone);
        $pst->bindParam(':jobtitle', $staff__jobtitle);
        $pst->bindParam(':staffID', $staffID);

        $count = $pst->execute();


        if($count){
            header("Location: staffdirectory_list.php?updatesuccess=yes");
            return $count;
        } else {
            echo "Problem updating staff member.";
        }
    }

    public function deleteStaff($dbcon, $staffID)
    {
        $sql = "DELETE FROM staff_directory WHERE staffID = :id";

        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':id', $staffID);

        $count = $pst->execute();
        if($count){
            header("Location: staffdirectory_list.php?deletesuccess=yes");
            return $count;
        } else {
            echo "Problem updating staff member.";
        }
    }


}