<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api')->except('create');
    }

    public function index()
    {
      return response()->json(Auth::user());
    }

    public function create(Request $request)
    {
      $this->validate($request, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6',
      ]);

      $user = User::create([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('password')),
          'api_token' => str_random(60),
      ]);

      return $user->makeVisible('api_token')->toJson();
    }

    public function update(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
      ]);

      $user = Auth::user();
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->save();
      return $user->toJson();
    }

    public function delete()
    {
      Auth::user()->delete();
    }

    public function campaign()
    {
      return Auth::user()->campaigns->toJson();
    }
}
