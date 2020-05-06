<?php


// Function to hold value before form submits so inputs don't get lost:

function holdvalue ($value)
{
    if (isset($value)) {
        echo $value;
    }
}


// Field Trips arrays to be used in function displayselectedoptions below:
$starttimearray = array(
    "" => "Select Start Time",
    "09:00:00" => "09:00AM",
    "10:00:00" => "10:00AM",
    "11:00:00" => "11:00AM",
    "12:00:00" => "12:00PM",
    "13:00:00" => "01:00PM",
    "14:00:00" => "02:00PM",
);


$endtimearray = array(
    "" => "Select End Time",
    "10:00:00" => "10:00AM",
    "11:00:00" => "11:00AM",
    "12:00:00" => "12:00PM",
    "13:00:00" => "01:00PM",
    "14:00:00" => "02:00PM",
    "15:00:00" => "03:00PM"
);

// Staff Directory arrays to be used in function displayselectedoptions below:
$jobtitles = array(
    '' => 'Please Select One:',
    'Child Care Worker' => 'Child Care Worker',
    'Caretaker' =>'Caretaker',
    'Administrator' => 'Administrator'
);


// Function to populate <option> tags:
function displayselectoptions ($array, $id = null, $name = null)
{
    foreach ($array as $key => $value) {
        $selected = "";
        if ($id == $key) {
            $selected = "selected";
        }
        if ($_POST[$name] == $key) {
            $selected = "selected";
        }
        echo "<option value='$key' $selected >$value</option>";
    }
}

?>

<script>
// Function to format date to SQL friendly format:
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + (d.getDate() + 1),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('/');
}

// var dater = formatDate('2014-05-11');
// console.log(dater);

</script>








