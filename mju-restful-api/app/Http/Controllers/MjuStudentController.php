<?php

namespace App\Http\Controllers;

use App\Models\MjuStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\updatedataMjustudentRequest;
class MjuStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = MjuStudent::all(); //ดึงข้อมูลจากฐานข้อมูลโดยใช้โมเดล MjuStudent
        return $students; //เก็บข้อมูลทั้งหมดลงในตัวแปร $students หลงจากเก็บข้อมูลเสร็จ จะมีคําสั่งreturnเพื่อที่จะreturnค่าทั้งหมดออกไป และดึงมาใช้แสดงผล

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
        $validated = $request->validate([ 'student_code' => 'required|string|max:15',  //ใช้เพิ่มข้อมูลลงในdatabase
        'first_name' => 'required|string|max:50', 
        'first_name_en' => 'required|string|max:50', 
        'major_id' => 'required|exists:majors,major_id', 
        'idcard' => 'required||digits:13', 
        'address' => 'required|string', 
        'phone' => 'required|string', 
        'email' => 'required|email',
     ]); 
        MjuStudent::create($validated); 
        return response()->json(['message' => 'Student created successfully'],  //ถ้าทำสำเร็จจะแสดงคำว่า Student created successfully
        201);
        //
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request,MjuStudent $mjuStudent)
    {
        //return "hello show";
        Log::info($request->mju);
        $student_code = $request->mju;
        $mjuStudent = MjuStudent::where('student_code',$student_code)->get(); //แสดงข้อมูลที่ต้องการออกมาตามเลข studentcode
        // ค้นหาตามรหัสนักศึกษา
        return response()->json (
            [
                'message' => 'Student get successfully',
                'get Data by' => 'guide',
                'data' => $mjuStudent],
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MjuStudent $mjuStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatedata(Request $request, $data)
    {
       $Student =  MjuStudent::where('student_code', $data)->first();  //ใช้อัพเดตข้อมูลในข้อมูลที่เลือก
        $validated = $request->validate([
            'student_code' => 'required|string|max:12', 
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'first_name_en' => 'required|string|max:50',
            'last_name_en' => 'required|string|max:50',
            'birthdate' => 'required|string|max:50',
            'gender' => 'required|string|max:1',
            'major_id' => 'required|exists:majors,major_id',
            'idcard' => 'required||digits:13',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);
        $Student->update($validated);

        return response()->json([
            'message' => 'Student update successfully',
            'get Data by'=>'อัพเดตข้อมูลเรียบร้อย',
            'data'=>$data], 200
        );
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MjuStudent $mjuStudent, $delete)
    {
       $deletedt = DB::table('mju_students')
       ->where('student_code',$delete)
       ->delete(); 
        return response()->json(
            [
                'message'=>'Student get successfully',
                'get Data by'=>'ลบข้อมูลเรียบร้อย',
                'data'=>$deletedt
            ],
            200
        );
    }
}
