<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserDataTable $dataTable)
    {
        $roles = Role::select('id', 'name')->get()->toArray();
        return $dataTable->render('user', compact('roles'));
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
            'email' => 'required',
        ]);
        try {
            $obj = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $condition = ['id' => $request->id];

            $user = User::updateOrCreate(
                $condition,
                $obj
            );

            if ($request->role) {
                $role = Role::findOrFail($request->role);
                $user->assignRole($role);
            }

            DB::commit();
            if ($request->id) {
                return response()->json(["success" => true, "message" => 'Data Updated Successfully']);
            } else {
                return response()->json(["success" => true, "message" => 'Data Created Successfully']);
            }
        } catch (\Exception $e) {
            dd($e);
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
        $user = User::find($id);
        return response()->json(["success" => true, "data" => $user]);
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
            $user = User::findOrFail($id);
            $user->destroy($id);

            DB::commit();
            return response()->json(["success" => true, "message" => 'Data Deleted Successfully']);
        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }
    }
}
