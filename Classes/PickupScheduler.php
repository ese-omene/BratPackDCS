<?php
class PickupScheduler {
    //we list all of the data
    public function listPickupSchedule($dbcon){
        $sql = "SELECT * FROM pickup_scheduler";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $pickupschedules = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $pickupschedules;
    }
    //query to submit data into the database
    public function newPickupSchedule($date, $child_first_name, $child_last_name, $pickup_first_name, $pickup_last_name, $pickup_phone_number, $pickup_email, $dbcon){
        $sql = "INSERT INTO pickup_scheduler (date, child_first_name, child_last_name, pickup_first_name, pickup_last_name,pickup_phone_number, pickup_email) VALUES (:date, :child_first_name, :child_last_name, :pickup_first_name, :pickup_last_name, :pickup_phone_number, :pickup_email)";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':date', $date);
        $pdostm->bindParam(':child_first_name', $child_first_name);
        $pdostm->bindParam(':child_last_name', $child_last_name);
        $pdostm->bindParam(':pickup_first_name', $pickup_first_name);
        $pdostm->bindParam(':pickup_last_name', $pickup_last_name);
        $pdostm->bindParam(':pickup_phone_number', $pickup_phone_number);
        $pdostm->bindParam(':pickup_email', $pickup_email);

        $insert = $pdostm->execute();
        return $insert;
    }
    //to get all the information about a specific entry
    public function getPickupSchedulebyId($id, $dbcon){
        $sql = "SELECT * FROM pickup_scheduler WHERE id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);

        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }
    // query to update database information about a specific entry
    public function updatePickupSchedule($id, $date, $child_first_name, $child_last_name, $pickup_first_name, $pickup_last_name, $pickup_phone_number, $pickup_email, $dbcon){
        $sql = "UPDATE pickup_scheduler
                SET date = :date,
                child_first_name = :child_first_name,
                child_last_name = :child_last_name,
                pickup_first_name = :pickup_first_name,
                pickup_last_name = :pickup_last_name,
                pickup_phone_number = :pickup_phone_number,
                pickup_email = :pickup_email
                WHERE id = :id
        
        ";

        $pst =   $dbcon->prepare($sql);

        $pst->bindParam(':date', $date);
        $pst->bindParam(':child_first_name', $child_first_name);
        $pst->bindParam(':child_last_name', $child_last_name);
        $pst->bindParam(':pickup_first_name', $pickup_first_name);
        $pst->bindParam(':pickup_last_name', $pickup_last_name);
        $pst->bindParam(':pickup_phone_number', $pickup_phone_number);
        $pst->bindParam(':pickup_email', $pickup_email);
        $pst->bindParam(':id', $id);

        $updatePS = $pst->execute();
        return $updatePS;
    }
    //query based on the searckey submitted by the user
    public function searchPickupSchedule($pickup__searchkey, $dbcon){
        $sql = "SELECT * FROM pickup_scheduler WHERE (child_first_name LIKE '%" . $pickup__searchkey . "%') OR (child_last_name LIKE '%" . $pickup__searchkey . "%')";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $searchPickup = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $searchPickup;
    }
    //ordering the data by date in ascending order
    public function searchPickupByDate($dbcon){
        $sql = "SELECT * FROM pickup_scheduler ORDER BY pickup_scheduler.date ASC";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $pickupschedules = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $pickupschedules;

    }
    //query to delete data from the database
    public function deletePickupSchedule($id, $dbcon){
        $sql = "DELETE FROM pickup_scheduler WHERE id = :id";

        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

}