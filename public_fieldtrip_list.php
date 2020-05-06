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


?>

<div class="container">
    <h1>Field Trips</h1>

    <div class="navbar">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="fieldtrip__searchkey" id="fieldtrip__searchkey" placeholder="Search"  aria-label="Search">
            <button class="btn" type="submit">Search</button>
        </form>
        <?php echo $fieldtrip__alltrips; ?>
    </div>



    <table class="table" style="width:100%">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Location</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Organizer</th>
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
                    <a class="btn btn-primary" href="public_fieldtrip_show.php?tripID=<?= $fieldtrip['fieldtripID'] ?>">View Trip Details</a>
                </td>
            </tr>
        <?php }; ?>
        </tbody>
    </table>
</div>

<?php
include "includes/footer.php";
?>
