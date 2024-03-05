<?php
    session_start();
    if(isset($_SESSION['userID']) && isset($_GET['key_pass']) && $_GET['key_pass'] === "khulJaSimSim")  {
        // json data format 
        // data = JSON.stringify(
        // {
        //     table: edit_table,
        //     edit_column: field,
        //     data : value ,
        //      
        // });
        include_once('db/_conn.php');
        // include_once('lib/_validation.php');

        $data = json_decode(file_get_contents("php://input") , true);

        $table = $data['table'];
        $edit_column = $data['edit_column'];

        // if the profile picture is requested to change
        if($table == 'users_avatar') {
            include 'lib/_insert_data.php';
            $img['type'] = $data['data']['img_type'];
            $img['img_data'] = base64_decode($data['data']['img_data']);
            $img['size'] = $data['data']['size'];

            $img['tmp_name'] = tempnam(sys_get_temp_dir() , 'uploaded_img_');
            file_put_contents($img['tmp_name'] , $img['img_data']);

            echo uploadImg(getDecryptedUserID() , $img);
            exit();
        }

        if($edit_column == 'user-name'){
            $full_name = explode(" " , $data['data']);
            if(count($full_name) == 1){
                $surname = "";
                $name = $full_name[0];
            }else if(count($full_name) > 1){
                $surname = $full_name[0];
                $name = $full_name[1];
                for($i = 2 ; $i < count($full_name) ; $i++){
                    $name.=" " . $full_name[$i];
                }
            }else{
                echo 0;
                exit();
            }
        }

        $edit_req = updateData($table , ( $edit_column == "user-name") ? "surname,name" :  "$edit_column"  , ( $edit_column == "user-name") ? "$surname,$name" : $data['data'] , "userID" , getDecryptedUserID());
        
        echo $edit_req;
    }else{
        echo 0;
    }
?>