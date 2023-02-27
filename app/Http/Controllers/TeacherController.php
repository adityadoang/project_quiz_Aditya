<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts from Models
        $teachers = Teachers::latest()->get();

        //return view with data
        return view('teachers', compact('teachers'));
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
            'id'     => 'required',
            'name'   => 'required',
            'city'   => 'required',
            'subject'   => 'required',
            'POB'   => 'required',
            'DOB'   => 'required',
            'Subject_id'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $teachers = Teachers::create([
            'id'     => $request->id, 
            'name'   => $request->name,
            'city'   => $request->city,
            'subject'   => $request->subject,
            'pob'   => $request->pob,
            'dob'   => $request->dob,
            'Subject'   => $request->subject_id,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $teachers
        ]);
    }
    /**
     * show
     *
     * @param  mixed $subjects
     * @return void
     */
    public function show(Teachers $teachers)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $teachers
        ]); 
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Teachers $teachers)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id'     => 'required', 
            'name'   => 'required',
            'city'   => 'required',
            'subject'   => 'required',
            'pob'   => 'required',
            'dob'   => 'required',
            'Subject'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $teachers->update([
            'id'     => $request->id, 
            'name'   => $request->name,
            'city'   => $request->city,
            'subject'   => $request->subject,
            'pob'   => $request->pob,
            'dob'   => $request->dob,
            'Subject'   => $request->subject_id,
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $teachers
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
        Teachers::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]); 
    }
}