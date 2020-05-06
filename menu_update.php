<?php
include 'includes/header.php';

if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
$name = $description = "";

if(isset($_POST['menu__update'])){
    $id= $_POST['id'];

    require_once 'Classes/Database.php';
    require_once 'Classes/MySqlDatabase.php';
    $dbcon = Database::getDb();
    $m = new MySqlDatabase();
    $menu = $m->showMenu($dbcon,$id);

    $name = $menu->name;
    $description = $menu->description;
    $diet = $menu->dietid;
}
if(isset($_POST['updMenuItem'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['sid'];
    $diet = $_POST['diet'];
    //var_dump($diet);

    require_once 'Classes/Database.php';
    require_once 'Classes/MySqlDatabase.php';
    $dbcon = Database::getDb();
    $m = new MySqlDatabase();

    $menu = $m->updateMenu($dbcon,$name,$description,$id, $diet);

}
if(isset($_POST['deleteMenu'])){

    $id = $_POST['sid'];
    require_once 'Classes/Database.php';
    require_once 'Classes/MySqlDatabase.php';
    $dbcon = Database::getDb();
    $m = new MySqlDatabase();
    $menu = $m->deleteMenu($dbcon, $id);

}

?>


<h1 class="h1 text-center">Update Details for <?= $name ?></h1>

<div class="container">
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="name"></label>
            <input type="text"class="form-control" name="name" id="name" value="<?= $name?>" placeholder="Enter name">
            <span></span>
        </div>
        <div class="form-group">

            <textarea  name="description" rows="10" cols="100" placeholder="please enter a brief description of the menu item"><?=  $description;?></textarea>
            <span></span>
        </div>
        <div class="form-group">
            <label for="diet">Diet</label>
            <div>
                <input type="radio" name="diet" id="diet" value="1" <?php echo ($diet == '1')?'checked':'' ?>>Regular<br>
                <input type="radio" name="diet" id="diet" value="2" <?php echo ($diet == '2')?'checked':'' ?>>Vegetarian<br>
            </div>
            <span></span>
        </div>

        <button type="submit" name="updMenuItem" class="btn btn-primary" id="btn-submit">Update Menu Item</button>
        <button type="submit" name="deleteMenu" class="btn btn-danger" id="btn-delete">Delete Item</button>

    </form>

</div>
<a href="menu_list.php" id="btn_back" class="btn btn-success">Back</a>

</body>
<?php include 'includes/footer.php'?>