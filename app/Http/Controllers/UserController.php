<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('page.usuario', compact('users'));
    }
    public function store(UserRequest $request){
        $user=null;

        if(isset($request->id)){
            $user=U\ser::find($request->id);
        }else{
            $user=new User();
        }
        $user->name =$request->name;
        $user->email =$request->email;
        $user->tipo =$request->tipo;
        $user->password =bcrypt("1234Funcionario");
        $user->save();
        return redirect()->back();
    }
    public function apagar($id){
        User::find($id)->delete();
        return redirect()->back();
    }
}
