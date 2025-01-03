<?php

namespace App\Http\Controllers;

use App\Models\Yard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YardController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'yard_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        $yard = new Yard();

        $yard->yard_name = $request->yard_name;
        $yard->location = $request->location;
        $yard->email = $request->email;
        $yard->phone = $request->phone;

        $yard->save();

        return response()->json([
            'status' => 200,
            'message' => 'Yard created successfully',
            'user' => $yard,
        ], 200);
    }

    // display data
    public function getAll(Request $request)
    {
        $yards = Yard::all();  // Retrieve all users from the database

        return response()->json([
            'yards' => $yards,
        ]);
    }

    // edit
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'yard_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $yard = Yard::find($id);
            $yard->yard_name = $request->yard_name;
            $yard->location = $request->location;
            $yard->email = $request->email;
            $yard->phone = $request->phone;

            $yard->save();

            $data = [
                'status' => 200,
                'message' => 'car model updated successfully',
                'yard' => $yard,
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($id)
    {
        // Find the user record by ID
        $yard = Yard::find($id);

        if (!$yard) {
            return response()->json(['error' => 'yard not found'], 404);
        }

        // Delete the yard record
        $yard->delete();

        return response()->json(['message' => 'yard deleted successfully']);
    }
}
