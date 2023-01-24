<?php 
namespace App\Helper;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class LoginService{
    public $username, $password;
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }


    public function validateInputLogin(){
      
        $validator = Validator::make(["username" => $this->username,"password" => $this->password], [
            'username'  => ['required', 'string'],
            'password'  => ['required', 'string', Password::min(8)]
        ]);
        if($validator->fails()){
            return ['status' => false, 'message'=> $validator->messages()];
        }else{
            return ['status' => true];
        }
    }

    public function login($device_name){
        $validate = $this->validateInputLogin();
        if ($validate['status'] == false) {
            return $validate;
        }else{
            $user = User::where('username', $this->username)->first();
            if($user){
                if($user->status === 1){
                    if(Hash::check($this->password, $user->password)){
                        $token = $user->createToken($device_name)->plainTextToken;
                        return ['status' => true, 'token' => $token, 'username' => $user];
                    }else{
                        return ['status' => false, 'message' => 'incorrect password or username'];
                    }
                }else {
                    return ['status' => false, 'message' => "Account has not been activated, do well to contact us"];
                }
            }else{
                return ['status' => false, 'message' => 'Incorrect Credentials!'];
            }

        }

    }
    
}



