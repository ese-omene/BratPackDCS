<?php



class Activities {

    public function addActivity($dbcon, $addActivity__title, $addActivity__description){
        $sql = "INSERT INTO activities (activity_title, activity_description) VALUES (:title, :description)";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':title',$addActivity__title);
        $pst->bindParam(':description',$addActivity__description);

        $count = $pst->execute();
        if($count){
            header('Location: activities_list.php');
        }else{
            echo "Problem adding new activity, looks like we're playing hid and seek!";
        }


    }
    public function listActivities($dbcon){
        $sql = "SELECT * FROM  activities order by id desc limit 5";
        $pdostm = $dbcon ->prepare($sql);
        $pdostm->execute();

        $activities = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $activities;


    }
    public function showActivities($dbcon, $id){
        $sql = "SELECT * FROM activities where id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $activity = $pst->fetch(PDO::FETCH_OBJ);
        return $activity;


    }
    public function updateActivity($dbcon, $title, $description, $id){
        $sql = "UPDATE activities set activity_title = :title, activity_description = :description WHERE id=:id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':title',$title);
        $pst->bindParam(':description',$description);
        $pst->bindParam(':id',$id);

        $count = $pst->execute();
        if($count){
            header('Location: activities_list.php');
        }else {
            echo "problem updating activites, looks like it's duck duck goose again!";
        }

    }
    public function deleteActivities($dbcon,$id){
        $sql = "DELETE FROM activities WHERE id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id',$id);
        $count = $pst->execute();

        if($count){
            header('Location: activities_list.php');
        }else{
            echo "problem deleting, looks like we're playing again!";
        }

    }
    public function readActivities($dbcon){
        $sql = "SELECT * FROM activities order by id desc limit 5";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $activities = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $activities;
    }
}
?>