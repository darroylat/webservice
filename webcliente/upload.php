<?php

if($_POST) {
    $allowed = array('jpg', 'jpeg');

    if(isset($_FILES['uploadctl']) && $_FILES['uploadctl']['error'] == 0){

        $extension = pathinfo($_FILES['uploadctl']['name'], PATHINFO_EXTENSION);

        if(!in_array(strtolower($extension), $allowed)){
            echo '{"status":"error"}';
            exit;
        }

        if(move_uploaded_file($_FILES['uploadctl']['tmp_name'], "/yourpath/." . $extension)){
            echo '{"status":"success"}';
            exit;
        }
        echo '{"status":"error"}';
    }
    exit();
}