<?php
namespace App\Http\Controllers;
use App\ToDoUser;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

use Validator;
class LoginController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(),[
            'u_username'=> 'required',
            'u_password'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json(array(
              "status" => "failed",
              "message" => "Validation error: There was an error while processing data."
            ));
          }
          
          $pwd = Crypt::encryptString($request->input('u_password'));

          $ToDouser = ToDoUser::where('u_username', '=', $request->input('u_username'))
          ->where('u_password' , '=',  $pwd)->get();
            print_r($ToDouser);
            return response()->json($ToDouser);
        
    }
}
