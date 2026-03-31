<?php 

//include SignUpValidator.php

use Exception;

require_once __DIR__ . '../../validators/SignupValidator.php';
//include UserRepository.php
require_once __DIR__ . '../../repositories/UserRepository.php';


class SignupService{

    protected $validator;
    protected $userRepository;

    public function __construct($validator, $userRepository){
        $this->validator = $validator;
        $this->userRepository = $userRepository;
    }
        
    public function signup($data){

       //validate the input logic
       $isValid = $this->validator->validate($data);
       
       if(!$isValid){
            throw new Exception("Invalid input field");
       }

       //check email existance
       $isEmailExist = $this->userRepository->findByEmail($data);

       if(!$isEmailExist){
            throw new Exception("User Already Exists");
       }

        //Hash Password 
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        //save the user 
        $created = $this->userRepository->create($data['name'], $data['email'], $hashedPassword);

        if(!$created){
            throw new Exception("User creation failed");
        }
        
        //return clean data
        return [
            'name' => $data['name'],
            'email' => $data['email']
        ];
    }
}

?>