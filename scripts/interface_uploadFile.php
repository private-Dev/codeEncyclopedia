<?php
/**
 * Created by PhpStorm.
 * User: root-home
 * Date: 15/11/2020
 * Time: 09:58
 */

Session_start();

if (!isset( $_SESSION['auth'])){
    // header('Location: ../login.php');
    exit();
}


if (isset($_FILES['files'])) {
    $data['success'] = false;
    $data['message'] = 'Success';
    $errors = [];

    $path = '../assets/upload/';
    $extensions = ['jpg', 'jpeg', 'png', 'gif'];

    $all_files = count($_FILES['files']['tmp_name']);

    for ($i = 0; $i < $all_files; $i++) {
        $file_name = $_FILES['files']['name'][$i];
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        $file_type = $_FILES['files']['type'][$i];
        $file_size = $_FILES['files']['size'][$i];

        //fix error assign by ref  $file_ext = strtolower(end(explode('.', $file_name)));
        $tmp = explode('.', $file_name);
        $file_ext = strtolower(end($tmp));

        $file = $path . com_create_guid() . ".".$file_ext;

        if (!in_array($file_ext, $extensions)) {
            $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
        }

        if ($file_size > 3097152) {
            $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
        }

        if (empty($errors)) {
           $data['success'] =  move_uploaded_file($file_tmp, $file);
        }
    }

    
    
    if (isset($data['success']) && $data['success']){
        $data['file'] = $file;
        
    }else{
        $data['errors'] = $errors;
        
    }
    echo json_encode($data);
}




function com_create_guid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }