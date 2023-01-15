<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use DeleteModelTrait;

    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = $this->role->latest()->paginate(7);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionParents'));
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
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);

        //Insert data to permission_role table (Bảng trung gian)
        $role->permissions()->attach($request->permission_id);

        return redirect(route('roles.index'));
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
        //get data Permission Parent
        $permissionParents = $this->permission->where('parent_id', 0)->get();

        $role = $this->role->find($id);

        //Get permissions checked
        $permissionsChecked = $role->permissions; //permissions is method in Role Model

        return view('admin.role.edit', compact('permissionParents', 'role', 'permissionsChecked',));
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
        $role = $this->role->find($id);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);


        //Insert data to permission_role table (Bảng trung gian)
        //if exist data is do not add new data === old data to table, if new data !== old data -> add new data to table
        $role->permissions()->sync($request->permission_id);

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        return  $this->deleteModelTrait($id, $this->role);
    }
}