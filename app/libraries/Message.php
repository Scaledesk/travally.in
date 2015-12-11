<?php
/**
 * Created by PhpStorm.
 * User: Javed
 * Date: 11/15/2015
 * Time: 12:06 PM
 */

namespace app\libraries;


class Messages {
    /*
     * callable messages method
     */
    public static function showErrorMessages($validator){
        $messages = $validator->messages();
        $errors=[];
        foreach ($messages->all() as $message)
        {
            array_push($errors,$message);
        }
        return $errors;
    }
}