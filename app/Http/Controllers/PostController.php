<?php

namespace App\Http\Controllers;

use App\DataTables\PostsDataTable;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PostsDataTable $dataTable)
    {
        return $dataTable->render('post');
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
            'date' => 'required',
            'tittle' => 'required',
            'description' => 'required',
        ]);
        try {
            $formattedDate = $request->date;

            $obj = [
                'post_tittle' => $request->tittle,
                'post_description' => $request->description,
                'post_date' => $formattedDate,
            ];

            $condition = ['id' => $request->id];

            Post::updateOrCreate(
                $condition,
                $obj
            );

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
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json(["success" => true, "data" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $post = Post::findOrFail($id);
            $post->destroy($id);

            DB::commit();
            return response()->json(["success" => true, "message" => 'Data Deleted Successfully']);
        } catch (\Exception $e) {

            DB::rollback();
            throw $e;
        }
    }
}
