<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /* this function shows profile main page*/
    public function index()
    {
        return Inertia::render('Profile/Show', [
            'accounts' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'position' => $user->position,
                    'email' => $user->email,
                    'edit_url' => URL::route('edit.user', $user),
                    'delete_url' => URL::route('delete.profile', $user),
                ];
            }),
            'user' => User::find(Auth::user()->id),
            'tab' => 'edit'
        ]);
    }

    /*This function create new account*/
    public function create(ProfileRequest $request)
    {
        /* Creating new User Object inorder to create new user account base on incoming information*/
        $user = new User;
        $this->setupData($request, $user); // setting some common fields to avoid duplicate code
        $user->password = Hash::make($request->input('email'));
        $user->save();

        return Inertia::render('Profile/Show', [
            'accounts' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'position' => $user->position,
                    'email' => $user->email,
                    'edit_url' => URL::route('edit.user', $user),
                    'delete_url' => URL::route('delete.profile', $user),
                ];
            }),
            'user' => User::find(Auth::user()->id),
            'tab' => 'create'
        ]);

    }

    /*This function updates Specific user information*/
    public function update(ProfileRequest $request)
    {
        $user = User::find($request->input('id')); /*Finding the specified User to edit it's information*/

        $this->setupData($request, $user); /* Calling setup function to do some common task which is share among
                                              other functionalities*/
        $user->save();

        return Inertia::render('Profile/Show', [
            'accounts' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'position' => $user->position,
                    'email' => $user->email,
                    'edit_url' => URL::route('edit.user', $user),
                    'delete_url' => URL::route('delete.profile', $user),
                ];
            }),
            'user' => User::find(Auth::user()->id),
            'tab' => 'list'
        ]);
    }

    /* This method do some common functionalities between different methods to avoid from duplicate codes*/
    public function setupData(Request $request, User $user)
    {
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->position = $request->input('position');
        $user->email = $request->input('email');
    }

    /*This function is used to update user account password*/
    public function password(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('پسورد وارد شده اشتباه است.'));
                }
            }],
            'password' => ['required', 'confirmed'],
        ], [
            'required' => ' وارد نمودن :attribute الزامی می باشد ',
            'confirmed' => ':attribute و تکرار رمز عبور باهم تطابق ندارند',
        ], [
            'current_password' => 'پسورد فعلی',
            'password' => 'رمز عبور جدید',
            'password_confirmation' => 'تکرار رمز عبور'
        ]);

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return Inertia::render('Profile/Show', [
            'accounts' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'position' => $user->position,
                    'email' => $user->email,
                ];
            }),
            'user' => User::find(Auth::user()->id)
        ]);
    }

    /* A function to delete a user account */
    public function delete( User $user)
    {
        $user->delete();
    }

    /* A Function to edit Account*/
    public function edit(User $user)
    {
        $user->position = Auth::user()->position;
        return Inertia::render('Profile/Show', [
            'accounts' => User::all()->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'last_name' => $user->last_name,
                    'position' => $user->position,
                    'email' => $user->email,
                    'edit_url' => URL::route('edit.user', $user),
                    'delete_url' => URL::route('delete.profile', $user),
                ];
            }),
            'user' => $user,
            'tab' => 'edit'
        ]);
    }
}
