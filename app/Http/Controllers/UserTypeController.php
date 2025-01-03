<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserTypeController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'user_type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        // Create the User record
        $userType = new UserType();
        $userType->user_type = $request->user_type;
        $userType->save();

        return response()->json([
            'status' => 200,
            'message' => 'User type added successfully',
            'user' => $userType,
        ], 200);
    }

    public function getAllUserType(Request $request)
    {
        $userType = UserType::all();  // Retrieve all users from the database

        return response()->json([
            'userType' => $userType,
        ]);
    }

    // edit user type
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'user_type' => 'required',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $userType = UserType::find($id);
            $userType->user_type = $request->user_type;

            $userType->save();

            $data = [
                'status' => 200,
                'message' => 'user type updated successfully',
            ];

            return response()->json($data, 200);
        }
    }

    // delete car model
    public function delete($id)
    {
        // Find the user record by ID
        $userType = UserType::find($id);

        if (!$userType) {
            return response()->json(['error' => 'userType not found'], 404);
        }

        // Delete the userType record
        $userType->delete();

        return response()->json(['message' => 'userType deleted successfully']);
    }
}
