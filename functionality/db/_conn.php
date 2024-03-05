<?php
    $host = "localhost";
    $unm = "root";
    $pass = "";
    $db = "Botsapp";

    $GLOBALS['conn'] = new mysqli( $host , $unm , $pass , $db );

    if($GLOBALS['conn'] -> connect_error) {
        die("Database Connection failed: " . $GLOBALS['conn']->connect_error);
    } 

    // insert data by table , column as string seprated by ',' , values as string seprated by ',' 
    function insertData($table, $column_str , $values_str )   {
        try{
            $columns = explode(',' , $column_str);
            $values = explode(',' , $values_str);
            foreach($columns as $key => $val){
                $columns[$key] = trim($val);
            }
            foreach($values as $key => $val){
                $values[$key] = trim($val);
            }
    
            if(sizeof($columns) != sizeof($values))
                throw new Exception( "Columns size is not equal to values size", 400);
    
            $paramtypes =   str_repeat('s' , count($values));
            $column_str =   implode(',' , $columns);
            $values_str =   implode( ',' , array_fill(0 , count($values) , '?') );
    
            $query = "INSERT INTO `$table`($column_str) VALUES ($values_str)";
            $stmt = $GLOBALS['conn']->prepare($query);
            $stmt->bind_param($paramtypes , ...$values);
            $sqlfire = $stmt->execute();
            $stmt ->close();
        }catch(Exception $e) {
            return 0;
        }
        
        
        if($sqlfire) {
            return 1;
        }else {
            return 0;
        }
    }

    // fetch data by table name , column for where point , point value , parameter of columns you want to fetch
    function fetch_columns( $table , $point , $point_value , ...$columns){
        
        $query = "SELECT ". implode(' , ' , $columns) ." from `$table` WHERE `$point` = ?";
        $stmt  = $GLOBALS['conn'] -> prepare($query);
        $stmt->bind_param('s' , $point_value);
        $sqlfire = $stmt->execute();

        if($sqlfire){
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        }else {
            return 400;
        }
    }

    function updateData($table, $column_str , $values_str , $point, $point_value )   {

        $columns = explode(',' , $column_str);
        $values = explode(',' , $values_str);
        foreach($columns as $key => $val){
            $columns[$key] = trim($val);
        }
        foreach($values as $key => $val){
            $values[$key] = trim($val);
        }

        if(sizeof($columns) != sizeof($values))
            die(throw new Exception( "Columns size is not equal to values size", 400));

        $paramtypes =  str_repeat('s' , count($values));

        $str="";
        foreach($columns as $column){
            if($str != ""){
                $str.=",";
            }
            $str .= $column . " = ". ' ? ';
        }

        $query = "UPDATE `$table` SET $str WHERE `$point` = '$point_value'";
        $stmt = $GLOBALS['conn']->prepare($query);
        $stmt->bind_param($paramtypes , ...$values);
        $sqlfire = $stmt->execute();
        $stmt ->close();
        
        if($sqlfire) {
            return 1;
        }else {
            return 0;
        }
    }

    // delete users table data
    function deleteData($table,$userID){
        $query = "DELETE FROM `$table` WHERE `userID` = ?";
        $stmt = $GLOBALS['conn']->prepare($query);
        $stmt->bind_param('s' , $userID);
        $sqlfire = $stmt->execute();
        $stmt->close();

        return $sqlfire;
    }
?>