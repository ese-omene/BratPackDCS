<?php

include "includes/header.php";

require_once 'Classes/Database.php';
require_once 'Classes/MySqlDatabase.php';
require_once 'Classes/Activities.php';

if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}

$dbcon = Database::getDb();
$m = new MySqlDatabase();
$a = new Activities();
$menu = $m->readMenu($dbcon);
$activities = $a->readActivities($dbcon);


$mondayMenu = $menu[0]->name;
$tuesdayMenu = $menu[1]->name;
$wednesdayMenu = $menu[2]->name;
$thursdayMenu = $menu[3]->name;
$fridayMenu = $menu[4]->name;

$mondayActivity = $activities[0]->activity_title;
$tuesdayActivity = $activities[1]->activity_title;
$wednesdayActivity = $activities[2]->activity_title;
$thursdayActivity = $activities[3]->activity_title;
$fridayActivity = $activities[4]->activity_title;

?>
<div><h1>Welcome "Parent Name"</h1></div>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div>
                <h2>Children</h2>
                <ul class="list-group">
                    <li class="list-group-item">Child 1</li>
                    <li class="list-group-item">Child 2</li>
                </ul>
            </div>

            <div>
                <h2>Reminders</h2>
                <ul class="list-group">
                    <li class="list-group-item">Reminder 1</li>
                    <li class="list-group-item">Reminder 2</li>
                </ul>
            </div>
            <div>
                <h2>Artwork</h2>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="images/artwork/art-art-materials-artistic-arts-and-crafts-542556.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="images/artwork/closeup-photo-of-assorted-color-alphabets-1337387.jpg" alt="Second slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div>
                <h2><a href="public_activities_list.php"> Weekly Schedule</a></h2>
                <ul class="list-group">
                    <ul class="list-group">
                        <li class="list-group-item">Monday - <?=$mondayActivity?></li>
                        <li class="list-group-item">Tuesday - <?=$tuesdayActivity?></li>
                        <li class="list-group-item">Wednesday - <?=$wednesdayActivity?></li>
                        <li class="list-group-item">Thursday - <?=$thursdayActivity?></li>
                        <li class="list-group-item">Friday - <?=$fridayActivity?></li>
                    </ul>
                </ul>
            </div>
            <div>
                <h2><a href="public_menu_list.php"> Weekly Menu</a></h2>
                <ul class="list-group">

                    <li class="list-group-item">Monday - <?=$mondayMenu?>  </li>
                    <li class="list-group-item">Tuesday - <?=$tuesdayMenu?></li>
                    <li class="list-group-item">Wednesday - <?=$wednesdayMenu?></li>
                    <li class="list-group-item">Thursday - <?=$thursdayMenu?></li>
                    <li class="list-group-item">Friday - <?=$fridayMenu?></li>

                </ul>
            </div>
        </div>
    </div>
</div>
<?php
include "includes/footer.php";
?>



