<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password' => 'sometimes|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->save();

        return redirect()->route('users.index')->with('success', 'User information is saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $existing_user = User::findorFail($id);
        return view('backend.users.edit', compact('existing_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorfail($id);

        if(isset($_POST['updatedetails']))
        {
            $data = $this->validate($request, [
                'name'=>'required|string|max:255',
                'email'=>'required|string|email|max:255|unique:users,email,'.$user->id,
            ]);

            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            $user->save();

            return redirect()->route('users.index')->with('success', 'Users Information is updated successfully.');
        }
        elseif(isset($_POST['updatepassword']))
        {
            $data = $this->validate($request, [
                'oldpassword' => 'required',
                'new_password' => 'sometimes|min:8|confirmed|different:password',
            ]);

            if (Hash::check($data['oldpassword'], $user->password))
            {
                if (!Hash::check($data['new_password'] , $user->password))
                {
                    $newpass = Hash::make($data['new_password']);

                    $user->update([
                        'password' => $newpass,
                    ]);

                    session()->flash('success','Password is updated successfully.');
                    return redirect()->route('users.index');
                }
                else
                {
                    session()->flash('error','New password can not be old password!');
                    return redirect()->back();
                }
            }
            else
            {
                session()->flash('errorpass', 'Password does not match.');
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', "User is deleted successfully. ");
    }
}
