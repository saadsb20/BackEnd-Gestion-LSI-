<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    

   
    public function GetStu($semestre)
    {
        $users = User::where('id_semestre',$semestre)->get();
        return $users;
    }
    public function GetOneStu($id)
    {
        $user = User::where('id',$id)->get();
        return $user;
    }
    public function GetPro()
    {
        $users = User::whereRoleIs('Teacher')->get();
        return $users;
    }

     public function DeleteUser($id){
        $User = User::find($id);
        $User->delete();

        return response()->json('User deleted!');
    }
    public function update(Request $request, $id)
    {
       $Seance = User::find($id);
        $Seance->update($request->all());

        return response()->json('User updated!');
    }
}
