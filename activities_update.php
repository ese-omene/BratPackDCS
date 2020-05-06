<?php
include_once 'includes/header.php';
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
$title = $description = "";

if(isset($_POST['activity__update'])){

    $id = $_POST['id'];

    require_once 'Classes/Activities.php';
    require_once 'Classes/Database.php';


    $dbcon = Database::getDb();
    $a = new Activities();
    $activity = $a->showActivities($dbcon, $id);

    $title = $activity->activity_title;
    $description = $activity->activity_description;
}
if(isset($_POST['updActivity'])){
    $title = $_POST['updateActivity__title'];
    $description = $_POST['updateActivity__description'];
    $id = $_POST['sid'];

    require_once 'Classes/Activities.php';
    require_once 'Classes/Database.php';

    $dbcon = Database::getDb();
    $a = new Activities();

    $activity = $a->updateActivity($dbcon, $title, $description,$id);
}

?>
<h1 class="h1 text-center">Update Details for  <?= $title?></h1>
<div class="container">
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="updateActivity_title"> </label>
            <input type="text" class="form-control" name="updateActivity__title" id="updateActivity__title" value="<?=$title?>" placeholder="Enter Menu Item Name">
            <span></span>
        </div>
        <div class="form-group">
            <textarea name="updateActivity__description" rows="10" cols="100" placeholder="please enter a brief description of the menu item"><?=$description?></textarea>
            <span></span>
        </div>

        <button type="submit" name="updActivity" class="btn btn-primary " id="btn-submit">
           Update Activity
        </button>
    </form>

</div>
<a href="activities_list.php" id="btn_back" class="btn btn-success ">Back</a>
</body>
<?php  include 'includes/footer.php'?>
