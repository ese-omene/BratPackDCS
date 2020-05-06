<?php
include 'includes/header.php';
require_once 'Classes/Database.php';
require_once 'Classes/Activities.php';

if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

$dbcon = Database::getDb();
$a = new Activities();
$activities = $a->listActivities($dbcon);


?>
<div class="container">
    <h1 class="h1 text-center"> Weekly Activity Schedule - Edit View</h1>


<table class="table table-bordered tbl container">
    <thead>
    <tr>
        <th scope="col">Monday</th>
        <th scope="col">Tuesday</th>
        <th scope="col">Wednesday</th>
        <th scope="col">Thursday</th>
        <th scope="col">Friday</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <?php foreach ($activities as $a){?>

        <td>
            <h3><?=$a['activity_title']?></h3>
            <p><?=$a['activity_description']?></p>


            <form action="activities_update.php" method="post">
                <input type="hidden" name="id" value="<?= $a['id']?>"/>
                <input type="submit" class="button btn-primary" name="activity__update" value="Update"/>
            </form>

            <form action="activities_delete.php" method="post">
                <input type="hidden" name="id" value="<?=$a['id']?>"/>
                <input type="submit" class="button btn-danger" name="activity__delete" value="Delete"/>
            </form>
        </td>

    <?php }?>
    </tr>
    </tbody>
</table>

    <a href="activities_add.php" class="btn btn-secondary">Add Activity</a>
</div>
    <a href="admin.php" class="btn btn-sub">Back</a>
</body>
    <?php include 'includes/footer.php'?>
