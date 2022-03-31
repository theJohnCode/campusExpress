<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $users = User::orderBY('id','DESC')->get();

        return view('backend.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "fullname" => 'required|string',
            "username" => 'string|nullable',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:4',
            "phone" => 'string|nullable',
            "address" => 'string|nullable',
            "role" => "required|in:admin,vendor,customer",
            "status" => "required|in:active,inactive",
            "photo" => 'required',
        ]);

        $data = $request->all();
        
        $data['password'] = Hash::make($request->password);

        // dd($data);

        $status = User::create($data);

        if ($status) {
            return redirect()->route('user.index')->with('success', 'User created successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
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
        $user = User::find($id);

        if ($user) {
            return view('backend.user.edit', compact(['user']));
        } else {
            return back()->with('error', 'Data not found');
        }
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
        $user = User::find($id);

        if ($user) {

            $request->validate([
                "fullname" => 'required|string',
                "username" => 'string|nullable',
                "email" => 'required|email|exists:users,email',
                //"password" => 'required|min:4',
                "phone" => 'string|nullable',
                "address" => 'string|nullable',
                "role" => "required|in:admin,vendor,customer",
                "photo" => 'required',
            ]);

            $data = $request->all();

            

            $status = $user->fill($data)->save();

            if ($status) {
                return redirect()->route('user.index')->with('success', 'User updated successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Data not found');
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
        $user = User::find($id);

        if ($user) {
            $status = $user->delete();
            if ($status) {
                return redirect()->route('user.index')->with('success', 'User successfully deleted');
            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function userStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('users')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('users')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Status changed successfully', 'status' => true]);
    }
}
