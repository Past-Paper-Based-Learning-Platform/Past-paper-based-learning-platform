<?php
class Configuration
{
    function createConnection(){

       // Create connection
       $dbcon = mysqli_connect("localhost","root","", "systemppdb");

        // Check connection
        if (!$dbcon) {
        die("Connection failed: " . mysqli_connect_error());
        return mysqli_connect_error();
        }
        //echo "Connected successfully";
        return $dbcon;
    }

    function closeConnection(){
        if(isset($this->createConnection))
        {
            $this->createConnection->close();
        }
    }

    function hashPassword($password){ 
        
        $hashedPW = sha1($password); 

        return $hashedPW;
    }

    function getSubjects(){
        $con = self::createConnection();
        $subjects=array();
        $query = "select * from subject";
        $results = $con->query($query);
        while ($row_ah = mysqli_fetch_assoc($results)) {
            array_push($subjects, $row_ah);
        }
        self::closeConnection();
        return $subjects;
    }

}
?>