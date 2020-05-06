<?php
include "includes/header.php";

require_once 'Classes/Database.php';
require_once 'Classes/StaffDirectory.php';

$staff__searchkey = "";
$public__jobtitle= "";
$staff__allstaff = "";

// If a search has been made, show a button "See All Staff" to display all results again:
if(isset($_GET['staff__searchkey'])){
    $staff__searchkey = $_GET['staff__searchkey'];
    $staff__allstaff = "<a href='public_staffdirectory_list.php' class='btn btn-secondary'>See All Staff</a>";
}

// Filter results by jobtitle if get variable exists:
if(isset($_GET['jobtitle'])){
    $public__jobtitle = $_GET['jobtitle'];
}

$dbcon = Database::getDb();
$sd = new StaffDirectory();
$staffmembers = $sd->liststaff($dbcon, $staff__searchkey, $public__jobtitle);


?>

<div class="container">
    <h1>Staff Directory</h1>

    <div class="navbar">

        <form class="form-inline my-2 my-lg-0" >
            <input class="form-control mr-sm-2" type="search" name="staff__searchkey" id="staff__searchkey" placeholder="Enter Name"  aria-label="Search">
            <input class="btn" type="submit" name="submit__searchstaff" value="Search Staff by Name">
        </form>
        <div class="dropdown">
            <button type="btn" class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter By Position: <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="public_staffdirectory_list.php" class="staff__dropdown_link">All Staff</a></li>
                <li><a href="public_staffdirectory_list.php?jobtitle=Administrator" class="staff__dropdown_link">Administrator</a></li>
                <li><a href="public_staffdirectory_list.php?jobtitle=Child" class="staff__dropdown_link" >Child Care Worker</a></li>
                <li><a href="public_staffdirectory_list.php?jobtitle=Caretaker" class="staff__dropdown_link">Caretaker</a></li>
            </ul>
        </div>
        <?php echo $staff__allstaff; ?>
    </div>
    <!--Display alert message if staff not found-->
    <?php if (empty($staffmembers)){ echo "<div class='alert alert-danger' role='alert'>Staff member not found.</div>";} ?>
    <?php foreach ($staffmembers as $staffmember) { ?>
        <div class="staff__container">
            <img src="<?= $staffmember['photo'] ?>" class="staff__container_photo">
            <div class="staff__container_info">
                <div class="font-weight-bold"><?= $staffmember['firstname'] . " " . $staffmember['lastname']?></div>
                <div><?= $staffmember['jobtitle'] ?></div>
                <div><?= "<a href='mailto:" . $staffmember['email'] . "'>" . $staffmember['email'] . "</a>"; ?></div>
                <div><?= $staffmember['phone'] ?></div>
            </div>
        </div>
    <?php } ?>


</div>




<?php
include "includes/footer.php";
?>
