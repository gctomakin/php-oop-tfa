<?php

class UsersVO  {

  private $firstname;
  private $lastname;
  private $email;
  private $password;
  private $secret;

  public function getFirstname(){

    return $this->firstname;

  }

  public function setFirstname($firstname){

    $this->firstname = $firstname;

  }

  public function getLastname(){

    return $this->lastname;

  }

  public function setLastname($lastname){

    $this->lastname = $lastname;

  }

  public function getEmail(){

    return $this->email;

  }

  public function setEmail($email){

    $this->email = $email;

  }

  public function getPassword(){

    return $this->password;

  }

  public function setPassword($password){

    $this->password = $password;

  }

  public function getSecret(){

    return $this->secret;

  }

  public function setSecret($secret){

    $this->secret = $secret;

  }


}
?>