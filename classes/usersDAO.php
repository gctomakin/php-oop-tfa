<?php
class UsersDAO {

    private $db;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    public function __construct(Database $db){

      $this->db = $db;

    }

    public function insert(UsersVO $user){

      $this->firstname = $user->getFirstname();
      $this->lastname = $user->getLastname();
      $this->email = $user->getEmail();
      $this->secret = $user->getSecret();
      $this->password = password_hash($user->getPassword(), PASSWORD_DEFAULT);

      $sql = "insert into `users` (`firstname`, `lastname`, `email`, `password`, `secret`) values (:firstname, :lastname, :email, :password, :secret)";

      $stmt = $this->db->conn->prepare($sql);

      $stmt->bindParam(':firstname', $this->firstname);
      $stmt->bindParam(':lastname', $this->lastname);
      $stmt->bindParam(':email', $this->email);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':secret', $this->secret);
      $result = $stmt->execute();

      if($result):

        return '<div data-alert class="alert-box success radius">Registered Successfully.<a href="#" class="close">&times;</a></div>';

      else:

        return '<div data-alert class="alert-box alert radius">Registration Failed.<a href="#" class="close">&times;</a></div>';


      endif;

      $this->db->conn->close();

    }

    public function login(UsersVO $user){

      $this->email = $user->getEmail();
      $this->password = $user->getPassword();

      $sql="SELECT * FROM `users` WHERE email=:email";
      $stmt = $this->db->conn->prepare($sql);
      $stmt->bindParam(':email', $this->email);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if($stmt->rowCount() > 0 && password_verify($this->password, $result['password'])):

          return $result['secret'];

      else:

          return '<div data-alert class="alert-box alert radius">Login Failed.<a href="#" class="close">&times;</a></div>';

      endif;




    }
}
?>
