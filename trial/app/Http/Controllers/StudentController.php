<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();

        $data = [
            'status' => 200,
            'student' => $student,
        ];

        return response()->json($data, 200);
    }

    public function studentIndex(Request $request)
    {
        echo json_encode($request, JSON_PRETTY_PRINT);
        // $student = Student::all();
        // $student = Student::find(1);
        // $count = Student::where('email', '=', 'kanjarogo@gmail.com')->get();

        // echo json_encode($count, JSON_PRETTY_PRINT);
        // exit;
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;

            $student->save();

            $data = [
                'status' => 200,
                'message' => 'Data uploaded successfully',
            ];

            return response()->json($data, 200);
        }
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;

            $student->save();

            $data = [
                'status' => 200,
                'message' => 'student updated successfully',
            ];

            return response()->json($data, 200);
        }
    }

    public function del(Request $request, $id)
    {
        $student = Student::find($id);

        $student->delete();

        $data = [
            'status' => 200,
            'message' => 'student destroyed successfully',
        ];

        return response()->json($data, 200);
    }
}
