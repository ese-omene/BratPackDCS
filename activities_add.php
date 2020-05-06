<?php
include_once 'includes/header.php';
require_once 'Classes/Database.php';
require_once 'Classes/Activities.php';

if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}

$error = FALSE;

if(isset($_POST['addActivity'])){
    //form values
    $addActivity__title = $_POST['addActivity__title'];
    $addActivity__description = $_POST['addActivity__description'];

    //check for data
    if($addActivity__title == ""){
        $titleError = "Please enter a title";
        $error = TRUE;
    }
    if($addActivity__description == ""){
        $descriptionError = "Please enter a description";
        $error = TRUE;
    }
    if ($error == FALSE) {
        header('Location:');
        //exit;
    }
    $dbcon = Database::getDb();
    $a = new Activities();
    $numRowsAffected = $a->addActivity($dbcon,$addActivity__title,$addActivity__description);



}
?>

<h1 class="h1 text-center">Add Activity</h1>
    <div class="container">
        <form action="" method="post">
        <div class="form-group">
            <label for="addActivity__title"> </label>
            <input type="text" class="form-control" name="addActivity__title" id="addActivity__title"  placeholder="Enter Activity">
            <span></span>
        </div>
        <div class="form-group">
            <textarea name="addActivity__description" rows="10" cols="100" placeholder="please enter a brief description of the activity"></textarea>
            <span></span>
        </div>
        <button type="submit" name="addActivity" class="btn btn-primary" id="btn-submit">
            Add Activity
        </button>
    </form>
    </div>
    <a href="activities_list.php" id="btn_back" class="btn btn-success">Back</a>
</body>
<?php
include 'includes/footer.php'
?>