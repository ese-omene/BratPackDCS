<?php
include "includes/header.php";
//database connection
require_once 'Classes/Database.php';
require_once 'Classes/MySqlDatabase.php';

if ($_SESSION['userinfo']['type'] !== 'admin'){
    header('Location: index.php');
}
$searchkey="";
$dbcon = Database::getDb();
$m = new MySqlDatabase();
$menu = $m->listMenu($dbcon, $searchkey);




?>


<div class="container">
<h1 class="h1 text-center">Weekly Daycare Menu - Edit View</h1>


    <!-- calendar via table formatting -->
    <table class="table table-bordered tbl container">
        <thead>
        <tr>
        <th scope="col">Monday</th>
        <th scope="col">Tuesday</th>
        <th scope="col">Wednesday</th>
        <th scope="col">Thursday</th>
        <th scope="col">Friday</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($menu as $m){ ?>
                <td>
                    <h2><?=$m['name']?></h2>


                    <p><?= $m['description']?></p>

<div>                    <form action="menu_update.php" method="post">
                        <input type="hidden" name="id" value="<?=$m['id'];?>" />
                        <input type="submit" class="button btn btn-primary" name="menu__update" value="Update" />
                    </form>
</div>
                    <div>
                    </div>
                </td>
            <?php }?>
        </tr>
        </tbody>
    </table>
    <a href="menu_add.php" id="btn_addMenu" class="btn btn-secondary">Add Menu Item</a>
</div>
    <a href="admin.php" class="btn btn-sub">Back</a>
    </body>
<?php
include "includes/footer.php";
?>