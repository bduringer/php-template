<?php
namespace app\framework\classes;
class Auth{
    public static function check(string $type){
        switch ($type) {
            case 'auth':
                if(!isset($_SESSION['loggd'])){
                    return redirect('/login');
                };
            break;
            
            default:
                # code...
                break;
        }

    }
}