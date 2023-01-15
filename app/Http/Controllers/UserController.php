<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    //use trait
    use DeleteModelTrait;
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = $this->user->latest()->paginate(6);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();



            //insert data to users table
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                // 'password' => Hash::make($request->password)
                'password' => bcrypt($request->password)
            ]);

            //insert data to user_role table
            $roleIds = $request->role_id; //get all role choose in select to array
            // foreach ($roleIds as $roleId) {
            //insert role_id into user_role table
            //     DB::table('user_role')->insert(['role_id' => $roleId, 'user_id' => $user->id]);
            // }
            //tương tự foreach ở trên nhưng sử dụng many to many relationship in laravel
            $user->roles()->attach($roleIds);

            DB::commit();

            return redirect(route('users.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message' . $e->getMessage() . 'line' . $e->getLine());
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
        $roles = $this->role->all();
        $user = $this->user->find($id);
        $rolesOfUser = $user->roles;

        return view('admin.user.edit', compact('roles', 'user', 'rolesOfUser'));
        // return view('admin.user.edit', compact('user'));
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
        try {
            DB::beginTransaction();

            //insert data to users table
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $user = $this->user->find($id);


            //insert data to user_role table
            $array_roleIds = $request->role_id; //get all role choose in select to array

            //if exist role is do not add new role === old role to table, if new role !== old role -> add new role to roles table
            $user->roles()->sync($array_roleIds); //roles is method in Model User
            DB::commit();

            return redirect(route('users.index'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Message' . $e->getMessage() . 'line' . $e->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {


        //Cách 1: use deleteModelTrait method in Trait\DeleteModelTrait
        return  $this->deleteModelTrait($id, $this->user);

        // Cách 2:
        // try {
        //     //code...
        //     $this->user->find($id)->delete();

        //     return response()->json([
        //         'code' => 200,
        //         'message' => 'success',
        //     ], 200);
        // } catch (\Exception $e) {
        //     Log::error('Message' . $e->getMessage() . 'line' . $e->getLine());


        //     //if have error
        //     return response()->json([
        //         'code' => 500,
        //         'message' => 'fail'
        //     ], 500);
        // }
    }
}