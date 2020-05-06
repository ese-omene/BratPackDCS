<?php
include 'includes/header.php';
//database connection
require_once 'Classes/Database.php';
//class used to add a menu item
require_once 'Classes/MySqlDatabase.php';

if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
//set data
$diet = $dietErr= "";
$description=$descriptionErr ="";
$name = $nameErr= "";
//error handling
$error = False;
//let's add a new menu item
if(isset($_POST['addMenuItem'])){
    //get the values from form
    $name = $_POST['name'];
    $description = $_POST['description'];
    $diet = $_POST['diet'];

    //check for data
    if($name == ""){
        $nameErr = "<div class=\"alert alert-danger\">Please enter name.</div>";
        $error=True;
    }
     if ($description == "") {
         $descriptionErr = "<div class=\"alert alert-danger\">Please enter a description of the meal.</div>";
         $error=True;
     }
   if($diet==""){
       $dietErr="<div class=\"alert alert-danger\">Choose dietary restriction</div>";
       $error=True;
   }
   if($error == FAlSE){
       $dbcon = Database::getDb();
       $addMenu = new MySqlDatabase();
       $add = $addMenu->addMenuItem($dbcon,$name,$description,$diet);

       if($add){
           header('Location: menu_list.php');
       } else {
           echo "problem inserting new menu item, looks like we're having leftovers";
       }
   }





}
?>


<h1 class="h1 text-center">Add Menu Item</h1>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <label for="name"> </label>
            <input type="text" class="form-control" name="name" id="name" value="" placeholder="Enter Menu Item Name">
            <span><?=$nameErr?></span>
        </div>
        <div class="form-group">
            <textarea name="description" rows="10" cols="100" placeholder="please enter a brief description of the menu item"></textarea>
            <span><?=$descriptionErr?></span>
        </div>
        <div class="form-group">
            <label for="diet">Diet</label>
            <div>
            <input type="radio" name="diet" id="diet" value="1">Regular<br>
            <input type="radio" name="diet" id="diet" value="2">Vegetarian<br>
            </div>
            <span><?=$dietErr?></span>
        </div>

        <button type="submit" name="addMenuItem" class="btn btn-primary " id="btn-submit">
            Add New Menu Item
        </button>
    </form>

</div>
<a href="menu_list.php" id="btn_back" class="btn btn-success ">Back</a>
</body>
<?php  include 'includes/footer.php'?>





