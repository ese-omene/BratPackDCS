<?php
//database connection
include_once 'includes/header.php';
require_once 'Classes/Database.php';
require_once 'Classes/MySqlDatabase.php';

if ($_SESSION['userinfo']['type'] !== 'parent'){
    header('Location: index.php');
}

$dbcon = Database::getDb();
$m = new MySqlDatabase();
$d = new MySqlDatabase();
$diets = $d->listdiets($dbcon);
$menu = $m->listMenu($dbcon);
if(isset($_POST['Vegetarian'])){
    $diet = $_POST['Vegetarian'];
    $menu = $m->dietMenu($dbcon, $diet);

}

?>



<h1 class="h1 text-center">Weekly Daycare Menu</h1>
<div class="m-1 ">
    <!-- calendar via table formatting -->
    <table class="table table-bordered tbl container">
        <thead>
        <th scope="col">Monday</th>
        <th scope="col">Tuesday</th>
        <th scope="col">Wednesday</th>
        <th scope="col">Thursday</th>
        <th scope="col">Friday</th>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($menu as $m){ ?>
                <td>
                    <h2><?= $m['name']?> </h2>


                    <p><?= $m['description']?></p>
                </td>
            <?php }?>
        </tr>
        </tbody>
    </table>
</div>
<form action=" " method="post" >

    <?php foreach ($diets as $diet){?>
        <button type="submit" name="<?=$diet['dietname']?>"  class= "btn btn-primary"  id="btn-submit" value=<?=$diet['dietid']?>>
            <?=$diet['dietname']?>
        </button>
    <?php }?>
</form>
<a href="public_interface.php" class="btn btn-sub">Back</a>

<?php
include "includes/footer.php";
?>
