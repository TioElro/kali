<?php
include 'db.php';
class User extends DB{
    private $nombre;
    private $username;
    private $estadoorigen;
    private $ciudadorigen;


    public function userExists($user, $pass){
        $md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $md5pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->nombre = $currentUser['name'];
            $this->usename = $currentUser['username'];
            $this->estadoorigen = $currentUser['estado'];
            $this->ciudadorigen = $currentUser['ciudad'];
        }
    }

    public function getNombre(){
        $_SESSION['estadouser']=$this->estadoorigen;
        $_SESSION['ciudaduser']=$this->ciudadorigen;
        return $this->nombre;
    }

}

?>
