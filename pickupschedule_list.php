<?php
include "includes/header.php";

require_once "Classes/Database.php";
require_once "Classes/PickupScheduler.php";

//"admin" user will have access to this page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

// if user uses the search bar the data matching the search will be showed
if(isset($_GET['searchPickup'])){
    $dbcon = Database::getDb();
    $ps = new PickupScheduler();
    $pickup__searchkey = $_GET['pickup__searchkey'];
    $pickupscheds = $ps->searchPickupSchedule($pickup__searchkey,$dbcon);

}
// if the user sorts by date, the data will be sorted in ascending order showing the one with the closest date first
    else if (isset($_GET['searchPickupByDate']))  {
    $dbcon = Database::getDb();
    $ps = new PickupScheduler();
    $pickupscheds = $ps->searchPickupByDate($dbcon);
}
// if not, we show the whole list of schedules
    else {
    $dbcon = Database::getDb();
    $ps = new PickupScheduler();
    $pickupscheds = $ps->listPickupSchedule($dbcon);
}

?>

<div class="container">
    <h1>Students Pickup Schedules </h1>
    <div class="navbar">
    <form class="form-inline my-2 my-lg-0" method="GET">
        <input class="form-control mr-sm-2" id="search" type="text" name="pickup__searchkey" placeholder="Search By Child...">
        <input class="btn btn-sub" id="submit" name="searchPickup" type="submit" value="Search">
    </form>

        <div>
            <form class="form-inline my-2 my-lg-0" method="GET">
                <input class="btn btn-secondary" name="searchPickupByDate" type="submit" value="Sort By Date">
            </form>
        </div>
        <div>
            <a href="pickupschedule_list.php" class="btn btn-sub">Full List View</a>
            <!-- if the user wants to see the data in a calendar view -->
            <a href="pickupschedule_list_calendar.php" class="btn btn-sub">Calendar View</a>
        </div>
    </div>
    <table class="table">
        <thead class="thead-cust">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Pickup Date</th>
            <th scope="col">Child First Name</th>
            <th scope="col">Child Last Name</th>
            <th scope="col">Pickup First Name</th>
            <th scope="col">Pickup Last Name</th>
            <th scope="col">Pickup Phone Number</th>
            <th scope="col">Pickup Email</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($pickupscheds as $pickup_s) {
            ?>
            <tr>
                <td><?= $pickup_s['id'] ?></td>
                <td><?= $pickup_s['date'] ?></td>
                <td><?= $pickup_s['child_first_name'] ?></td>
                <td><?= $pickup_s['child_last_name'] ?></td>
                <td><?= $pickup_s['pickup_first_name'] ?></td>
                <td><?= $pickup_s['pickup_last_name'] ?></td>
                <td><?= $pickup_s['pickup_phone_number'] ?></td>
                <td><?= $pickup_s['pickup_email'] ?></td>
                <td>
                    <form action="pickupschedule_update.php" method="post">
                        <input type="hidden" name="id" value="<?= $pickup_s['id'] ?>"/>
                        <input type="submit" class="button btn btn-up" name="updatePickupSchedule" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="pickupschedule_delete.php" method="post">
                        <input type="hidden" name="id" value="<?= $pickup_s['id'] ?>"/>
                        <input type="submit" class="button btn btn-del" name="deletePickupSchedule" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>

</div>

<?php
include "includes/footer.php";
?>
