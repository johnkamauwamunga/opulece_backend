<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    // create new model
    // create new vehicle
    public function create(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year_made' => 'required|date',
            'mileage' => 'required|string|max:255',
            'fuel_type' => 'required|in:Petrol,Diesel,Electric',
            'transmission' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'status' => 'required|in:Available,Sold',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages(),
            ], 422);
        }

        // Create the User record
        $car = new Car();
        $car->make = $request->make;
        $car->model = $request->model;
        $car->year_made = $request->year_made;
        $car->mileage = $request->mileage;
        $car->fuel_type = $request->fuel_type;
        $car->transmission = $request->transmission;
        $car->description = $request->description;
        $car->price = $request->price;
        $car->status = $request->status;
        $car->save();

        // If the user type is "Staff", create a Staff record
        if ($car) {
            $image = new Image();
            $image->car_id = $car->id; // Set the foreign key
            $image->image_url = $request->image_url; // Assign role
            $image->save();
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data uploaded successfully',
            'user' => $car,
        ], 200);
    }

    public function getAll(Request $request)
    {
        $car = Car::all();  // Retrieve all users from the database

        return response()->json([
            'vehicle' => $car,
        ]);
    }

    // edit
    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'year_made' => 'required|date',
                'mileage' => 'required|string|max:255',
                'fuel_type' => 'required|in:Petrol,Diesel,Electric',
                'transmission' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|string|max:255',
                'status' => 'required|in:Available,Sold',
            ]
        );

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                'message' => $validator->messages(),
            ];

            return response()->json($data, 422);
        } else {
            $car = Car::find($id);
            $car->year_made = $request->year_made;
            $car->mileage = $request->mileage;
            $car->fuel_type = $request->fuel_type;
            $car->transmission = $request->transmission;
            $car->description = $request->description;
            $car->price = $request->price;
            $car->status = $request->status;

            $car->save();

            if ($car) {
                $image = new Image();
                $image->car_id = $car->id; // Set the foreign key
                $image->image_url = $request->image_url; // Assign role
                $image->save();
            }

            $data = [
                'status' => 200,
                'message' => 'vehicle updated successfully',
                'car_model' => $car,
            ];

            return response()->json($data, 200);
        }
    }

    public function delete($id)
    {
        // Find the user record by ID
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['error' => 'car not found'], 404);
        }

        // Delete the car record
        $car->delete();

        return response()->json(['message' => 'car deleted successfully']);
    }
}
