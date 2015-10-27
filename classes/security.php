<?php

class Security{

  private static $data;

  public static function sanitize($data){

    trim($data);
    stripslashes($data);
    htmlspecialchars($data);

    return $data;

  }

}

?>