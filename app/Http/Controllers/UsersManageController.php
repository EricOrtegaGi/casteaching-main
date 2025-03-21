<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\Feature\Users\UsersManageControllerTest;

class UsersManageController extends Controller
{
    public static function testedBy()
    {
        return UsersManageControllerTest::class;
    }

    public function index()
    {
        return view('users.manage.index',[
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        add_personal_team($user);


        session()->flash('status', 'Successfully created');

        return redirect()->route('manage.users');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.manage.show', compact('user'));
    }

    public function edit($id)
    {
        return view('users.manage.edit', [
            'user' => User::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('status', 'Successfully updated');
        return redirect()->route('manage.users');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        session()->flash('status', 'Successfully removed');
        return redirect()->route('manage.users');
    }
}
