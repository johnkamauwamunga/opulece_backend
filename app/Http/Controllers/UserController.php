<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'user_type' => 'required|in:Staff,Customer',
            // 'password' => 'required|string|min:6',
            'role' => 'required_if:user_type,Staff|in:sales Agent,Yard Staff,Manager',
            'hire_date' => 'required_if:user_type,Staff|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        // Create the User record
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->user_type = $request->user_type;
        $user->password = $request->password; // Hash the password
        $user->save();

        // If the user type is "Staff", create a Staff record
        if ($request->user_type === 'Staff') {
            $staff = new Staff();
            $staff->users_id = $user->id; // Set the foreign key
            $staff->role = $request->role; // Assign role
            $staff->hire_date = $request->hire_date; // Assign hire date

            $staff->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data uploaded successfully',
            'user' => $user,
        ], 200);
    }

    public function getAllUsers(Request $request)
    {
        // You can add a check to ensure that only admin or authorized users can access this route
        $users = User::all();  // Retrieve all users from the database

        return response()->json([
            'users' => $users,
        ]);
    }

    // edit
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'user_type' => 'required|in:Staff,Customer',
                // 'password' => 'required|string|min:6',
                'role' => 'required_if:user_type,Staff|in:sales Agent,Yard Staff,Manager',
                'hire_date' => 'required_if:user_type,Staff|date',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->user_type = $request->user_type;
            $user->password = $request->password; // Hash the password
            $user->save();

            // If the user type is "Staff", handle related staff record
            if ($user->user_type === 'Staff') {
                // Find or create the related staff record
                $staff = $user->staff ?? new Staff();
                $staff->users_id = $user->id;
                $staff->role = $request->role;
                $staff->hire_date = $request->hire_date;
                $staff->save();
            } else {
                // If user type is not Staff, delete any related staff record
                if ($user->staff) {
                    $user->staff->delete();
                }
            }

            $data = [
                'status' => 200,
                'message' => 'User updated successfully',
                'car_type' => $user,
            ];

            return response()->json($data, 200);
        }
    }

    // delete user
    public function deleteuser($id)
    {
        // Find the user record by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Check if the user has a related staff record
        $staff = $user->staff; // Get the related staff record if it exists

        if ($staff) {
            // Delete the related staff record first
            $staff->delete();
        }

        // Delete the user record
        $user->delete();

        return response()->json(['message' => 'User and related staff deleted successfully']);
    }
}
