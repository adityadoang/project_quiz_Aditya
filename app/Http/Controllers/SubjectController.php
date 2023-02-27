<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts from Models
        $subjects = Subjects::latest()->get();

        //return view with data
        return view('subjects', compact('subjects'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'subject'   => 'required',
            'hours'   => 'required',
            
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $subjects = Subjects::create([
            'id'     => $request->id, 
            'subject'   => $request->subject,
            'hours'   => $request->hours,
            
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $subjects
        ]);
    }
    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Subjects $subjects)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $subjects  
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Subjects $subjects)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id'     => 'required',
            'subject'   => 'required',
            'hours'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $subjects->update([
            'id'     => $request->id, 
            'subject'   => $request->subject,
            'hours'   => $request->hours,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $subjects
        ]);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //delete post by ID
        Subjects::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]); 
    }
}