<?php
class Menu {
    public function listMenu($dbcon){
        $sql = "SELECT * FROM menus order by id desc limit 5";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $menu = $pdostm->fetchAll(PDO::FETCH_ASSOC);
        return $menu;

    }

}