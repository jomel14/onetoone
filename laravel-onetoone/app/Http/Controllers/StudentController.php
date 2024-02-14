<?php

namespace App\Http\Controllers;
use App\Models\Student;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = Student::with('academic')->get();
        return response()->json(['students' => $students]);
    }

    public function store(Request $request){
        $student = Student::create($request->all());
        $student -> academic()->create($request->input('academic'));
        return response()->json($student, 201);
    }

    public function update(Request $request, $id){
        $student = Student::find($id);
        $student -> update($request->all());    
        $student -> academic()->update($request->input('academic'));
        return response()->json(['student'=> $student]);
    }

    public function destroy($id){
       $student = Student::find($id);
       $student -> academic()->delete();
       $student->delete();
       return response()->json(['message'=> "succesfully deleted the user"]);
    }
}