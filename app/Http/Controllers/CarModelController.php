<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{
    public function create(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'car_model' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        // Create the User record
        $carrModel = new CarModel();
        $carrModel->car_model = $request->car_model;
        $carrModel->save();

        return response()->json([
            'status' => 200,
            'message' => 'Car make successfully',
            'user' => $carrModel,
        ], 200);
    }

    // fetch all models
    public function getAll(Request $request)
    {
        $carModel = CarModel::all();  // Retrieve all users from the database

        return response()->json([
            'car_model' => $carModel,
        ]);
    }

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
            $carModel = CarModel::find($id);
            $carModel->car_model = $request->car_model;

            $carModel->save();

            $data = [
                'status' => 200,
                'message' => 'car model updated successfully',
                'car_model' => $carModel,
            ];

            return response()->json($data, 200);
        }
    }

    // delete car model
    public function delete($id)
    {
        // Find the user record by ID
        $carModel = CarModel::find($id);

        if (!$carModel) {
            return response()->json(['error' => 'carModel not found'], 404);
        }

        // Delete the carModel record
        $carModel->delete();

        return response()->json(['message' => 'car model deleted successfully']);
    }
}
