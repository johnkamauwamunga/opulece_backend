<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarTypeController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'car_type' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        // Create the User record
        $carType = new CarType();
        $carType->car_type = $request->car_type;
        $carType->save();

        return response()->json([
            'status' => 200,
            'message' => 'Car make successfully',
            'user' => $carType,
        ], 200);
    }

    // edit

    // edit
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'car_model' => 'required',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $carType = CarType::find($id);
            $carType->car_model = $request->car_model;

            $carType->save();

            $data = [
                'status' => 200,
                'message' => 'car model updated successfully',
                'car_type' => $carType,
            ];

            return response()->json($data, 200);
        }
    }

    // get
    public function getAll(Request $request)
    {
        $carType = CarType::all();  // Retrieve all users from the database

        return response()->json([
            'carType' => $carType,
        ]);
    }

    // delete car model
    public function delete($id)
    {
        // Find the user record by ID
        $carType = CarType::find($id);

        if (!$carType) {
            return response()->json(['error' => 'carType not found'], 404);
        }

        // Delete the carType record
        $carType->delete();

        return response()->json(['message' => 'carType deleted successfully']);
    }
}
