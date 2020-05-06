<?php
include_once 'includes/header.php';
//database connection
require_once 'Classes/Database.php';
require_once 'Classes/MySqlDatabase.php';

$menu__searchkey = "";
$menu__fullmenu = "";


if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}


$dbcon = Database::getDb();
$m = new MySqlDatabase();
$d = new MySqlDatabase();
$s = new MySqlDatabase();
$diets = $d->listdiets($dbcon);
$menu = $m->listMenu($dbcon);
$search = $s->searchMenu($dbcon, $menu__searchkey);
//var_dump($search);
var_dump($menu__searchkey);

if(isset($_POST['Vegetarian'])){
    $diet = $_POST['Vegetarian'];
    $menu = $m->dietMenu($dbcon, $diet);
}

if(isset($_GET['menu__searchkey']) && $_GET['menu__searchkey'] != ""){
    $menu__searchkey = $_GET['menu__searchkey'];
    $menu__fullmenu = "<a href='menu_show.php' class='btn btn-secondary'>Full Menu</a>";
    //need to work on formatting so single menu item in view maintains day of the week
  //  $search_results =  "<p>" .$search[0]->name."</p>";


}



?>




<div class="container ">
    <h1 class="h1 text-center">Weekly Daycare Menu</h1>
    <!-- calendar via table formatting -->
    <div class="navbar">
        <form class="form-inline my-2 my-lg-0" method="GET">
            <input class="form-control mr-sm-2" type="search" name="menu__searchkey" id="menu__searchkey" placeholder="Search"  aria-label="Search">
            <input class="btn" type="submit" name="submit__searchmenu" value="Search Menu">
        </form>
        <?php echo $menu__fullmenu; ?>
    </div>
    <table class="table table-bordered tbl ">
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

   <?php echo $search_results;?>

<form action=" " method="post" >

    <?php foreach ($diets as $diet){?>
    <button type="submit" name="<?=$diet['dietname']?>"  class= "btn btn-primary"  id="btn-submit" value=<?=$diet['dietid']?>>
       <?=$diet['dietname']?>
    </button>
        <?php }?>
</form>
</div>
<a href="admin.php" class="btn btn-sub">Back</a>

<?php
include "includes/footer.php";
?>
