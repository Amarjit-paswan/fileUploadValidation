<?php 

class SignUpValidator implements UserValidatorInterface{
    public function validate($data)
    {
        $name = trim($data['name']);
        $email = trim($data['email']);
        $password = trim($data['password']);
        $confirmPassword = trim($data['confirmPassword']);

        //check name is empty
        if(empty($name)){
            throw new Exception("Name must be required");
        }
        if(strlen($name) < 4){
            throw new Exception("Name character must be more than 3 char");
        }

        //check email is empty
        if(empty($email)){
            throw new Exception("Email must be required");
        }
        if(!filter_var($name, FILTER_VALIDATE_EMAIL)){
            throw new Exception("Email is invalid");
        }

        //password pattern
        $passwordPattern = '/^[a-zA-z0-9%/-+]{4,20}$/';
        //check password is empty and format
        if(empty($password)){
            throw new Exception("Password must be required");
        }
        if(!preg_match($passwordPattern,$password)){
            throw new Exception("Passowrd format is invalid");
        }

        //check confirm password is equal to passowrd
        if(empty($confirmPassword)){
            throw new Exception("Confrim Password must be required");
        }
        if($confirmPassword !== $password){
            throw new Exception("Confirm password doesn't matched");
        }

        
    }
}



?>