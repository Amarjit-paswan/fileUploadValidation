<?php 

class VerificationTokenRepository{

    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function createToken($userId,$token, $expiry){
        $sql = "INSERT INTO verfication_tokens (user_id, token, expiry, status) VALUES (?, ?, 'pending')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$userId, $token, $expiry]);
    }

    public function findByToken($token){
        $sql = "SELECT * FROM verfication_tokens WHERE token = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$token]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // update token status 
    public function updateTokenStatus($token){
        $sql = "UPDATE verfication_tokens SET status = 'used' WHERE token = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$token]);
    }
}


?>