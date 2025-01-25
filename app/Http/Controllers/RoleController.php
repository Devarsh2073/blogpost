<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $dataTable)
    {
        $permission = Permission::get()->toArray();
        $grpPermission = collect($permission)->groupBy('group_name');

        return $dataTable->render('role', compact('grpPermission'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $request->validate([
            'name' => 'required',
        ]);
        try {
            if ($request->id) {
                $role = Role::find($request->id);
                $role->name = $request->name;
                $role->save();

                $role->givePermissionTo($request->permissions);
            } else {
                $role = Role::create(['name' => $request->name]);
                $role->givePermissionTo($request->permissions);
            }


            DB::commit();
            if ($request->id) {
                return response()->json(["success" => true, "message" => 'Data Updated Successfully']);
            } else {
                return response()->json(["success" => true, "message" => 'Data Created Successfully']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["success" => false, "message" => 'Opps Someting went wrong!!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return response()->json(["success" => true, "data" => $role, "rolePermissions" => $rolePermissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->destroy($id);

            DB::commit();
            return response()->json(["success" => true, "message" => 'Data Deleted Successfully']);
        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }
    }
}
