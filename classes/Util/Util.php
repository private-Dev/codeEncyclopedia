<?php
/**
 * Created by PhpStorm.
 * User: root-home
 * Date: 24/01/2021
 * Time: 09:51
 */

class Util
{

    public static function GETPOST($field, $type = ''){

        $fieldSelected = null;
        if (isset($_POST[$field]) && !empty($_POST[$field])) {
            $fieldSelected =  $_POST[$field];

            if ($type == "date"){
                $fieldSelected  = date("Y-m-d H:i:s", strtotime($_POST[$field]));
            }


        }else{
            if (isset($_GET[$field]) && is_null($fieldSelected)) {

                $fieldSelected =  $_GET[$field];

                /*if (in_array('order', array_keys($_GET))){

                    $fieldSelected = isset($_GET[$field]) ? $_GET[$field] : 'ASC';
                }*/


            }
        }
        return $fieldSelected ;
    }


}