<?php


namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserService{
    public $userid, $name, $username, $email, $password, $status;

    public function __construct($userid, $name, $username, $email, $password, $status)
    {
        $this->userid = $userid;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
    }

    public function validateInputRegister(){
        $validator = Validator::make(
            ["username" => $this->username, "name" => $this->name, "email" => $this->email, "password" => $this->password], [
            'username'  => ['required', 'string', 'unique:users'],
            'name'      => ['required', 'string'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'string', Password::min(8)]
        ]);
        if($validator->fails()){
            return ['status' => false, 'message'=> $validator->messages()];
        }else{
            return ['status' => true];
        }
    }


    public function register($device_name){
        $validate = $this->validateInputRegister();
        if ($validate['status'] == false) {
            return $validate;
        }else{
            $user = User::create([
                'userid'    => $this->userid,
                'username'  => $this->username,
                'name'      => $this->name,
                'email'     => $this->email,
                'password'  => Hash::make($this->password)
            ]);
            $token = $user->createToken($device_name)->plainTextToken;
            return ['status' => true, 'token' => $token, 'user' => $user];
        }
    }

}
