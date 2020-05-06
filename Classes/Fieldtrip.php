<?php

class Fieldtrip {


    public function listfieldtrips($dbcon, $fieldtrip__searchkey, $tripID){

        $sql = "SELECT * FROM fieldtrips JOIN staff_directory ON fieldtrips.staffID = staff_directory.staffID";
        $sql__order = " ORDER BY tripdate";

        if($fieldtrip__searchkey != ""){
            // Update the the query to include search:
            $sql__search = " WHERE LOWER(location) LIKE LOWER('%" . $fieldtrip__searchkey . "%') ORDER BY tripdate";
            $sql = $sql . $sql__search;
            // print_r($sql);
        } else if($tripID != ""){
            $sql__tripID = " WHERE fieldtripID = " . $tripID . " ORDER BY tripdate";
            $sql = $sql . $sql__tripID;
        } else {
            $sql = $sql . $sql__order;
        }
        //print_r($sql);

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $fieldtrips = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $fieldtrips;

    }


    public function addfieldtrip($dbcon, $fieldtrip__location, $fieldtrip__description, $fieldtrip__date, $fieldtrip__start, $fieldtrip__end, $fieldtrip__organizer ){

        $sql = "INSERT INTO fieldtrips (location, description, tripdate, starttime, endtime, staffID) VALUES (:location, :description, :tripdate, :startime, :endtime, :staff) ";
        $pst = $dbcon->prepare($sql);


        $pst->bindParam(':location', $fieldtrip__location);
        $pst->bindParam(':description', $fieldtrip__description);
        $pst->bindParam(':tripdate', $fieldtrip__date);
        $pst->bindParam(':startime', $fieldtrip__start);
        $pst->bindParam(':endtime',$fieldtrip__end);
        $pst->bindParam(':staff',$fieldtrip__organizer);


        $count = $pst->execute();
        if($count){
            header("Location: fieldtrip_list.php?addsuccess=yes");
            return $count;
        } else {
            echo "Problem adding new fieldtrip.";
        }
    }


    public function updatefieldtrip($dbcon, $fieldtrip__location, $fieldtrip__description, $fieldtrip__date, $fieldtrip__start, $fieldtrip__end, $fieldtrip__organizer, $tripID)
    {
        $sql = "UPDATE fieldtrips 
            SET location = :location,
            description = :description,
            tripdate = :tripdate,
            starttime = :startime,
            endtime = :endtime,
            staffID = :staffID
            WHERE fieldtripID = :tripID";

        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':location', $fieldtrip__location);
        $pst->bindParam(':description', $fieldtrip__description);
        $pst->bindParam(':tripdate', $fieldtrip__date);
        $pst->bindParam(':startime', $fieldtrip__start);
        $pst->bindParam(':endtime',$fieldtrip__end);
        $pst->bindParam(':staffID',$fieldtrip__organizer);
        $pst->bindParam(':tripID', $tripID);
        print_r($sql);

        $count = $pst->execute();
        print_r($count);

        if($count){
            header("Location: fieldtrip_list.php?updatesuccess=yes");
            return $count;
        } else {
            echo "Problem updating field trip.";
        }
    }
    
    
    public function deletefieldtrip ($dbcon, $fieldtripID){
        $sql = "DELETE FROM fieldtrips WHERE fieldtripID = :fieldtripID";
        $pst = $dbcon->prepare($sql);
        $pst->bindparam('fieldtripID', $fieldtripID);
        $count = $pst->execute();
        if($count){
            header('Location: fieldtrip_list.php?deletesuccess=yes');
            return $count;
        } else {
            echo "There was a problem deleting this fieldtrip.";
        }
    }




}