<?php

namespace App\Http\Controllers;

use App\Models\CarMake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarMakeController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'car_make' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        // Create the User record
        $carMake = new CarMake();
        $carMake->car_make = $request->car_make;
        $carMake->save();

        return response()->json([
            'status' => 200,
            'message' => 'Car make successfully',
            'make' => $carMake,
        ], 200);
    }

    // fetch all bodies
    public function getAll(Request $request)
    {
        $carMake = CarMake::all();  // Retrieve all users from the database

        return response()->json([
            'carMake' => $carMake,
        ]);
    }

    // edit car make

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'car_make' => 'required',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $carMake = CarMake::find($id);
            $carMake->car_make = $request->car_make;

            $carMake->save();

            $data = [
                'status' => 200,
                'message' => 'user type updated successfully',
                'car_make' => $carMake,
            ];

            return response()->json($data, 200);
        }
    }

    // delete carBody
    public function delete($id)
    {
        // Find the user record by ID
        $carMake = CarMake::find($id);

        if (!$carMake) {
            return response()->json(['error' => 'carMake not found'], 404);
        }

        // Delete the carMake record
        $carMake->delete();

        return response()->json(['message' => 'carMake deleted successfully']);
    }
}
