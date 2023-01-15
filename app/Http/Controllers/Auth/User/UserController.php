<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userClient;

    public function __construct(UserClient $userClient)
    {
        $this->userClient = $userClient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.user.home');
    }


    public function dologin(Request $request)
    {

        // $request->validate([
        //     'email' => 'required|email',
        //     "password" => 'required|min:6',
        // ]);

        //get email and password from user enter
        $check = $request->only('email', 'password');

        //check data
        if (Auth::guard('user_client')->attempt($check)) {
            return redirect()->route('user.index')->with("success", 'Dang nhap  thanh cong');
            // dd(route('user.index'));
        } else {
            return redirect()->back()->with("error", 'Dang nhap  that bai');
        }

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user_clients,email',
            "password" => 'required|min:6',
            "confirm_password" => "required|same:password" //required password ==== confirm_password
        ]);

        $data_userClient = $this->userClient->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            // 'password' => bcrypt($request->password)
        ]);


        if ($data_userClient) {
            return redirect()->back()->with("success", 'Dang ky tai khoan thanh cong');
        } else {
            return redirect()->back()->with("error", 'Dang ky tai khoan that bai');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}