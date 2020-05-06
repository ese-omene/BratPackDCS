<?php
include "includes/header.php";

require_once "Classes/Database.php";
require_once "Classes/Fieldtrip.php";

$fieldtrip__searchkey = "";
$fieldtrip__alltrips = "";
$tripID = "";

// If a search has been made, show a button "See All Field Trips" to display all results again:
if(isset($_GET['fieldtrip__searchkey']) && $_GET['fieldtrip__searchkey'] != ""){
    $fieldtrip__searchkey = $_GET['fieldtrip__searchkey'];
    $fieldtrip__alltrips = "<a href='fieldtrip_list.php' class='btn btn-secondary'>See All Field Trips</a>";
}


$dbcon = Database::getDb();
$ft = new Fieldtrip();
$fieldtrips = $ft->listfieldtrips($dbcon, $fieldtrip__searchkey, $tripID);
//print_r($fieldtrips);


// Success message if a trip has been successfully added:
if(isset($_GET['addsuccess']) && $_GET['addsuccess'] == 'yes'){
    ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> New field trip added.
    </div>
    <?php
}

// Success message if a trip has been successfully updated:
if(isset($_GET['updatesuccess']) && $_GET['updatesuccess'] == 'yes'){
    ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> Field trip updated.
    </div>

    <?php
}

// Success message if a trip has been successfully deleted:
if(isset($_GET['deletesuccess']) && $_GET['deletesuccess'] == 'yes'){
    ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Field trip successfully deleted.</strong>
    </div>
    <?php
}

?>

<div class="container">
    <h1>Field Trips</h1>

    <div class="navbar">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="fieldtrip__searchkey" id="fieldtrip__searchkey" placeholder="Search"  aria-label="Search">
            <button class="btn" type="submit">Search</button>
        </form>
        <?php echo $fieldtrip__alltrips; ?>
        <a href="fieldtrip_add.php" class="btn btn-secondary">Add New Field Trip</a>
    </div>


    <table class="table" style="width:100%">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Location</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Organizer</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <!--Display alert message if field trip not found-->
        <?php if (empty($fieldtrips)){ echo "<div class='alert alert-danger' role='alert'>Field trip not found.</div>";} ?>
        <?php foreach ($fieldtrips as $fieldtrip) { ?>
            <tr>
                <td><a href="fieldtrip_show.php?tripID=<?= $fieldtrip['fieldtripID']?>"><?= $fieldtrip['location'] ?></a></td>
                <td><?= $fieldtrip['tripdate'] ?></td>
                <td><?= $fieldtrip['starttime'] . ' - ' . $fieldtrip['endtime'] ?></td>
                <td><?= $fieldtrip['firstname'] . ' ' . $fieldtrip['lastname'] ?></td>
                <td>
                    <a class="btn btn-primary" href="fieldtrip_update.php?tripID=<?= $fieldtrip['fieldtripID'] ?>">Update</a>
                </td>
                <td>
                    <button type='button' class='btn btn-danger' data-toggle='modal' data-target="#deletefieldtrip<?=$fieldtrip['fieldtripID'] ?>">Delete</button>
                    <div class="modal fade" id="deletefieldtrip<?=$fieldtrip['fieldtripID'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Delete Field Trip Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="text-align: left;">Would you like to delete the following Field Trip:<strong> <?= $fieldtrip['location']?></strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="fieldtrip_delete.php?tripID=<?=$fieldtrip['fieldtripID'] ?>" class="btn btn-danger" >Delete Field Trip</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php }; ?>
        </tbody>
    </table>
</div>

<?php
include "includes/footer.php";
?>
