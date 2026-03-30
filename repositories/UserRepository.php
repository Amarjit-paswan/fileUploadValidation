<?php 

class UserRepository{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    //find user by email
    public function findByEmail($email){
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //create a new user
    public function create($name,$email,$password){


        $sql = "INSERT INTO users (name,email,password) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$name,$email,$password]);
    }
}

?>