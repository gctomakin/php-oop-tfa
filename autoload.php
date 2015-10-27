<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
spl_autoload_register(null, false);
spl_autoload_register('myAutoloader');

$a = $b = "";
include 'lib/GoogleAuthenticator.php';
function myAutoloader($className)
{
    $path = 'classes/';

    if(file_exists($path.$className . '.php')) {

        include $path.$className . '.php';

    } else {

        throw new Exception("Unable to load {$className}.");
    }
}


try {

    $db = Database::getInstance();
    $usersDAO = new UsersDAO($db);
    $usersVO = new UsersVO();
    $authenticator = new PHPGangsta_GoogleAuthenticator();
    //$security = new Security();

} catch (Exception $e) {

    throw new Exception($e->getMessage());
}
?>