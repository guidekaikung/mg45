<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function getStudents(Request $request)
    {
        // สมมติว่า $mju คือข้อมูลนักเรียนที่ถูกดึงมาจากฐานข้อมูล
        $mju = [
            // ข้อมูลนักเรียน
        ];

        // สร้าง JSON response
        return response()->json([
            'message' => 'Student get successfully', 
            'get Data by' => 'guide',
            'data' => $mju
        ], 200);
    }
        

}