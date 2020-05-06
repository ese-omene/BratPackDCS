<?php
include "includes/header.php";

require_once 'Classes/Database.php';
require_once 'Classes/StaffDirectory.php';

$staff__searchkey = "";
$staff__allstaff = "";
$public__jobtitle = "";
$staffsearcherrormsg = "";

// Filter results by jobtitle if get variable exists:
if(isset($_GET['jobtitle'])){
    $public__jobtitle = $_GET['jobtitle'];
}

// If a search has been made, show a button "See All Staff" to display all results again:
if(isset($_GET['staff__searchkey']) && $_GET['staff__searchkey'] != ""){
    $staff__searchkey = $_GET['staff__searchkey'];
    $staff__allstaff = "<a href='staffdirectory_list.php' class='btn btn-secondary'>See All Staff</a>";
}

$dbcon = Database::getDb();
$sd = new StaffDirectory();
$staffmembers = $sd->liststaff($dbcon, $staff__searchkey, $public__jobtitle);

// Success message if staff member has been successfully added:
if(isset($_GET['addsuccess']) && $_GET['addsuccess'] == 'yes'){
    ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> New staff member added to staff directory.
    </div>
    <?php
}

// Success message if staff member has been successfully updated:
if(isset($_GET['updatesuccess']) && $_GET['updatesuccess'] == 'yes'){
    ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Staff member updated in staff directory.
    </div>
    <?php
}

// Success message if staff member has been successfully deleted:
if(isset($_GET['deletesuccess']) && $_GET['deletesuccess'] == 'yes'){
    ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Staff member successfully deleted from staff directory.</strong>
    </div>
    <?php
}


?>

<div class="container">
    <h1>Staff Directory</h1>

    <div class="navbar">
        <form class="form-inline my-2 my-lg-0" method="GET">
            <input class="form-control mr-sm-2" type="search" name="staff__searchkey" id="staff__searchkey" placeholder="Enter Staff Name"  aria-label="Search">
            <input class="btn" type="submit" name="submit__searchstaff" value="Search Staff by Name">
        </form>
        <!-- Button appears only when searchkey exists:-->
        <?php echo $staff__allstaff; ?>
        <a href="staffdirectory_add.php" class="btn btn-secondary">Add New Staff</a>
        <a href="staffdirectory_list_pictures.php" class="btn btn-secondary">Grid View - Staff Directory</a>
    </div>

    <table class="table" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Staff Name</th>
                <th scope="col">
                    <span class="dropdown">
                        <span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Job Title <span class="caret"></span></span>
                        <ul class="dropdown-menu">
                            <li><a href="staffdirectory_list.php?" class="staff__dropdown_link">All Staff</a></li>
                            <li><a href="staffdirectory_list.php?jobtitle=Administrator" class="staff__dropdown_link">Administrator</a></li>
                            <li><a href="staffdirectory_list.php?jobtitle=Child" class="staff__dropdown_link">Child Care Worker</a></li>
                            <li><a href="staffdirectory_list.php?jobtitle=Caretaker" class="staff__dropdown_link">Caretaker</a></li>
                        </ul>

                </th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <!--Display alert message if staff not found-->
        <?php if (empty($staffmembers)){ echo "<div class='alert alert-danger' role='alert'>Staff member not found.</div>";} ?>
        <?php foreach ($staffmembers as $staffmember) { ?>
            <tr>
                <th>
                    <a href='staffdirectory_show.php?staffID=<?=$staffmember['staffID'] ?>' ><?= $staffmember['firstname'] . " " . $staffmember['lastname']?></a>
                </th>
                <td><?= $staffmember['jobtitle'] ?></td>
                <td><?= "<a href='mailto:" . $staffmember['email'] . "'>" . $staffmember['email'] . "</a>" ?></td>
                <td><?= $staffmember['phone'] ?></td>
                <td>
                    <a href='staffdirectory_update.php?staffID=<?=$staffmember['staffID'] ?>' class="button btn btn-primary" >Update Staff</a></td>
                </td>
                <td>
                    <button type='button' class='btn btn-danger' data-toggle='modal' data-target="#deletestaff<?=$staffmember['staffID'] ?>">Delete</button>
                    <div class="modal fade" id="deletestaff<?=$staffmember['staffID'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Delete Staff Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="text-align: left;">Would you like to delete <?= $staffmember['firstname'] . " " . $staffmember['lastname']?> from the staff directory?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="staffdirectory_delete.php?staffID=<?=$staffmember['staffID'] ?>" class="btn btn-danger" >Delete Staff</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
include "includes/footer.php";
?>
