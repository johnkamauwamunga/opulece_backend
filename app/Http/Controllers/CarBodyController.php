<?php

namespace App\Http\Controllers;

use App\Models\CarBody;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarBodyController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'body_type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        // Create the User record
        $carBody = new CarBody();
        $carBody->body_type = $request->body_type;
        $carBody->save();

        return response()->json([
            'status' => 200,
            'message' => 'Car Body successfully',
            'car_Body' => $carBody,
        ], 200);
    }

    // fetch all bodies
    public function getAll(Request $request)
    {
        $carbody = CarBody::all();  // Retrieve all users from the database

        return response()->json([
            'body_type' => $carbody,
        ]);
    }

    // edit car body

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'body_type' => 'required',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $carBody = CarBody::find($id);
            $carBody->body_type = $request->body_type;

            $carBody->save();

            $data = [
                'status' => 200,
                'message' => 'user type updated successfully',
                'car_Body' => $carBody,
            ];

            return response()->json($data, 200);
        }
    }

    // delete carBody
    public function delete($id)
    {
        // Find the user record by ID
        $carBody = CarBody::find($id);

        if (!$carBody) {
            return response()->json(['error' => 'car body not found'], 404);
        }

        // Delete the carBody record
        $carBody->delete();

        return response()->json(['message' => 'car body deleted successfully']);
    }
}
