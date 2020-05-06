<?php
include "includes/header.php";

require_once "Classes/Database.php";
require_once "Classes/PickupScheduler.php";

// only admins have access to the page
if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

//we grab the information from the database
$dbcon = Database::getDb();
$ps = new PickupScheduler();
$pickupscheds = $ps->listPickupSchedule($dbcon);


//we create an array of values for each schedule in the database
foreach($pickupscheds as $pickupsched)
{
    $data[] = array(
        'id'   => $pickupsched["id"],
        'start'   => $pickupsched["date"],
        'title'   => ($pickupsched["child_first_name"] . " " . $pickupsched["child_last_name"] . ".
        Being picked up by: " . $pickupsched["pickup_first_name"] . " " . $pickupsched["pickup_last_name"]) . "."

    );
}

?>
<!-- code referenced for fullCalendar jQuery : https://www.webslesson.info/2017/12/jquery-fullcalandar-integration-with-php-and-mysql.html, https://fullcalendar.io/docs -->
<!-- we create a function to show the calendar using the fullCalendar jQuery and echo the values we got from the database -->
    <script>

        $(document).ready(function() {
            var modal = document.getElementById("myModal");
            var eventInfo = document.getElementById("eventInfo");
            var span = document.getElementsByClassName("close-cal")[0];
            var calendar = $('#calendar').fullCalendar({
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },
                events: <?php echo json_encode($data); ?>,
                selectable:true,
                selectHelper:true,
                eventBackgroundColor: '#27968e',
                eventTextColor: 'white',
                allDay:true,
                // when the user clicks on the event we show a popup which shows the  main information about that entry
                //Using CSS/JS modal box referencing https://www.w3schools.com/howto/howto_css_modals.asp
                //this way we show a pop up window we can style
                eventClick: function(event) {
                    modal.style.display = "block";
                    eventInfo.innerHTML = "Student Name: " + event.title;
                }
            });
            span.onclick = function() {
                modal.style.display = "none";
            }
        });

    </script>
<div class="container">
    <h1>Students Pickup Schedules </h1>
    <div class="navbar">
        <a href="pickupschedule_list.php" class="btn btn-sub">Back to List View</a>
    </div>
        <div class="container">
            <div id="calendar"></div>
        </div>
    <div id="myModal" class="modal-cal">
        <!-- Modal content -->
        <div class="modal-content-cal">
            <div class="close-cal">&times;</div>
            <span id="eventInfo"></span>
        </div>

    </div>
</div>

<?php
include "includes/footer.php";
?>


