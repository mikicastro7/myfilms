<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Support\Facades\Log;

class AdminUsersController extends Controller
{
    public function Users(){
        return view('admin.usersAdmin');
    }
    public function getUsers(){
        return Datatables::of(User::query())->make(true);
    }
    public function addUser(Request $request){
        $user  = new User;
        $userName = $request->input('name');
        $userType = $request->input('type');
        $userMail = $request->input('email');
        $userPass = $request->input('password');
        if($userName == null){
            return response()->json(['error' => "Name field it's empty"], 500);
        }
        if($userType == null){
            return response()->json(['error' => "Type field it's empty"], 500);
        }
        if($userMail == null){
            return response()->json(['error' => "Email field it's empty"], 500);
        }

        if(strlen($userPass) < 8 || strlen($userPass) == null){
            return response()->json(['error' => "The password must be at least 8 characters long"], 500);
        }

        $user->name = $userName;
        $user->type = $userType;
        $user->email = $userMail;
        $user->password = bcrypt($userPass);

        $user->save();

        $notification = array(
            'message' => 'User created successfully!',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }
    public function deleteUser(Request $request){
        $user = User::find($request->user_id);
        $user->delete();
        $notification = array(
            'message' => 'User deleted',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }
    public function editUser(Request $request){
        $user = User::find($request->user_id);
        $userName = $request->input('name');
        $userType = $request->input('type');
        $userMail = $request->input('email');
        $userPass = $request->input('password');
        if($userName == null){
            return response()->json(['error' => "Name field it's empty"], 500);
        }
        if($userType == null){
            return response()->json(['error' => "Type field it's empty"], 500);
        }
        if($userMail == null){
            return response()->json(['error' => "Email field it's empty"], 500);
        }

        if(strlen($userPass) < 8 && strlen($userPass) != null){
            return response()->json(['error' => "The password must be at least 8 characters long"], 500);
        }

        $user->name = $userName;
        $user->type = $userType;
        $user->email = $userMail;

        if($userPass != null){
            $user->password = bcrypt($userPass);
        }
        $user->save();

        $notification = array(
            'message' => 'User Edited',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }

}

