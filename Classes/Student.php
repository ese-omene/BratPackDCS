<?php


class Student
{
    public function viewWaitlist($dbcon, $search_keyword)
    {
        //select all waitlisted students
        $sql = 'SELECT C.id, C.first_name, C.last_name, TIMESTAMPDIFF(YEAR, C.dob, CURDATE()) AS Age, CONCAT(P.first_name, " ", P.last_name) AS Parent_Name FROM children C
                JOIN parents P ON P.id = C.parent_id
                WHERE registration_status = "waitlist"';
        //Create the if statement to change the query based on the search term
        if ($search_keyword !== "") {
            $sql_searchkey = " AND C.first_name LIKE '%$search_keyword%' OR C.last_name LIKE '%$search_keyword%' OR P.first_name LIKE '%$search_keyword%' OR P.last_name LIKE '%$search_keyword%'";
            $sql = $sql . $sql_searchkey;
        }
        //execute sql and return the result
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $waitlist = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $waitlist;
    }

    public function viewStudents($dbcon, $search_keyword)
    {
        //select all registered students
        $sql = 'SELECT C.id, C.first_name, C.last_name, TIMESTAMPDIFF(YEAR, C.dob, CURDATE()) AS Age, CONCAT(P.first_name, " ", P.last_name) AS Parent_Name FROM children C
                JOIN parents P ON P.id = C.parent_id
                WHERE registration_status = "student"';
        //Create the if statement to pass through the search_keyword
        if ($search_keyword !== "") {
            $sql_searchkey = " AND C.first_name LIKE '%$search_keyword%' OR C.last_name LIKE '%$search_keyword%' OR P.first_name LIKE '%$search_keyword%' OR P.last_name LIKE '%$search_keyword%'";
            $sql = $sql . $sql_searchkey;
        }
        //Execute SQL command
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $student = $pdostm->fetchAll(PDO::FETCH_OBJ);
        return $student;
    }

    public function addStudent($dbcon, $fname, $lname, $dob, $parent_id)
    {
        //insert data
        $sql = 'INSERT INTO children (first_name, last_name, dob, registration_status, parent_id)
                VALUES (:fname, :lname, DATE(:dob), "waitlist", :parent_id)';
        $pdostm = $dbcon->prepare($sql);

        //$pst->bindParam(':id', $id);
        $pdostm->bindParam(':fname', $fname);
        $pdostm->bindParam(':lname', $lname);
        $pdostm->bindParam(':dob', $dob);
        $pdostm->bindParam(':parent_id', $parent_id);
        //execute SQL and return the result
        $count = $pdostm->execute();
        return $count;
    }

    public function updateStudent($dbcon, $id, $fname, $lname, $dob, $status)
    {
        //SQL Query
        $sql = 'UPDATE children SET first_name = :fname, last_name = :lname, dob = :dob, registration_status = :status WHERE id = :id';
        $pdostm = $dbcon->prepare($sql);

        //bind variables
        $pdostm->bindParam(':id', $id);
        $pdostm->bindParam(':fname', $fname);
        $pdostm->bindParam(':lname', $lname);
        $pdostm->bindParam(':dob', $dob);
        $pdostm->bindParam(':status', $status);

        //execute SQL and return the result
        $count = $pdostm->execute();
        return $count;
    }

    public function deleteStudent($id, $dbcon)
    {
        //SQL query
        $sql = 'DELETE FROM children WHERE id = :id';
        $pdostm = $dbcon->prepare($sql);
        //Bind parameteres
        $pdostm->bindParam(':id', $id);
        //execute SQL and return result
        $count = $pdostm->execute();
        return $count;
    }

    public function getSById($dbcon, $id)
    {
        //SQL query
        $sql = 'SELECT * FROM children where id = :id';
        $pst = $dbcon->prepare($sql);
        //Bind parameteres
        $pst->bindParam(':id', $id);
        //execute SQL and return result
        $pst->execute();
        return $pst->fetch(PDO::FETCH_OBJ);
    }

    public function updateStatus($dbcon, $id)
    {
        //SQL query
        $sql = 'UPDATE children SET registration_status = "student" WHERE id = :id';
        $pdostm = $dbcon->prepare($sql);
        //Bind parameteres
        $pdostm->bindParam(':id', $id);
        //execute SQL and return result
        $count = $pdostm->execute();
        return $count;
    }
}