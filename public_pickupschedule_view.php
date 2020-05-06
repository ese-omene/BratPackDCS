<?php
include "includes/header.php";

//parents have access to the schedule page
if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}
?>
    <div class="container__public">
        <h1>Schedule your child's pickup!</h1>
        <img src="images/icons/pickupschedule.png" class="icons" alt="Pickup Schedule Icon" width="100px" height="auto">
        <p>Having another person pick up your child from our Daycare?</p>
        <p>Fill out our Pickup Scheduler form!</p>
        <div class="public_contact"> <a href="pickupschedule_add.php" class="btn btn-sub">New Pickup Scheduler Form</a> </div>
    </div>

<?php
include "includes/footer.php";
?>