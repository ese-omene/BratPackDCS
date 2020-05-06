<?php


interface intDatabase {
    public function  addMenuItem($a,$x,$y,$z);
    public function listMenu($x);
    public function showMenu($x,$y);
    public function updateMenu($a,$b,$x,$y,$z);


}

class MySqlDatabase implements intDatabase {

    public function  addMenuItem($dbcon, $name, $description,$diet){
        $sql = "INSERT INTO menus  (name, description, dietid) VALUES (:name, :description, :diet)";
        $pst = $dbcon->prepare($sql);

        $pst->bindParam(':name', $name);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':diet', $diet);

        $add = $pst->execute();
        return $add;
    }

    public function listMenu($dbcon)
    {
        $sql = "SELECT * FROM menus";
        $limit = " where dietid = 1 order by id desc limit 5";

      //  if($staff__searchkey != ""){
        //    $sql__searchkey = " WHERE name LIKE '%".$staff__searchkey."%' ";
          //  $sql = $sql.$sql__searchkey;

        //} else {
            $sql = $sql.$limit;
        //}

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $menu = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $menu;
    }
    public function searchMenu($dbcon, $menu__searchkey)
    {
        $sql = "SELECT * FROM menus";
        $limit = " where dietid = 1 order by id desc limit 5";

        if($menu__searchkey != ""){
            $sql__searchkey = " WHERE name LIKE '%".$menu__searchkey."%' ";
            $sql = $sql.$sql__searchkey;

        } else {
            $sql = $sql.$limit;
        }

        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $menu = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $menu;
    }

    public function showMenu($dbcon, $id){
        $sql = "SELECT * FROM menus inner join diets where id = :id";
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        $menu = $pst->fetch(PDO::FETCH_OBJ);

        return $menu;

    }
    public function updateMenu($dbcon, $name, $description, $id, $diet){
        $sql = "UPDATE menus 
            set name = :name, 
            description = :description,
            dietid = :dietid 
            WHERE id= :id";

        $pst = $dbcon ->prepare($sql);

        $pst->bindParam(':name', $name);
        $pst->bindParam(':description', $description);
        $pst->bindParam(':dietid', $diet);
        $pst->bindParam(':id', $id);

        //return back to list view to confirm updated information
        $count = $pst->execute();
        if($count){
            header("Location: menu_list.php");
        } else {
            echo "problem updating menu, looks like it's leftovers again!";
        }
    }
    public function readMenu($dbcon){
        $sql = "SELECT * FROM menus  order by id desc limit 5";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $menu = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $menu;

    }
    public function dietMenu($dbcon, $diet){

        $sql = "SELECT * FROM menus  WHERE dietid = :diet order by id limit 5";

        $pdostm = $dbcon->prepare($sql);
        $pdostm->bindParam(':diet', $diet);
        $pdostm->execute();

        $menu = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $menu;
    }
    public function listdiets($dbcon)
    {
        $sql = "SELECT * FROM diets  ";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $diets = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $diets;
    }
    public function deleteMenu($dbcon, $id){
        $sql = "DELETE FROM menus WHERE id = :id";

        $dbcon = Database::getDb();
        $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();


        if($count){
            header("Location: menu_list.php");
        }
        else {
            echo "problem deleting";
        }
    }

}