<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PatientUpdateMail;
use Illuminate\Support\Facades\Log;

class LaboratoryTestController extends Controller
{
    /**
     * Display a listing of the available medical tests.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Return the available types of medical tests with their specific options.
        return response()->json([
            "x_ray" => [
                "Chest",
                "Cervical Vertebrae",
                "Thoracic Vertebrae",
                "Lumbar Vertebrae",
                "Lumbo Sacral Vertebrae",
                "Thoraco Lumbar Vertebrae",
                "Shoulder Joint",
                "Elbow Joint",
                "Wrist Joint",
                "Knee Joint",
                "Pelvic Joint",
                "Hip Joint",
                "Femoral",
                "Ankle",
                "Humerus",
                "Radius/Ulna",
                "Foot",
                "Sacro Iliac Joint",
                "Thoracic Inlet",
                "Tibia/Fibula",
                "Fingers",
                "Toes"
            ],
            "ultrasound_scan" => [
                "Obstetric",
                "Abdominal",
                "Pelvis",
                "Prostate",
                "Breast",
                "Thyroid"
            ],
            "ct_scan" => [
                "Head",
                "Chest",
                "Abdomen",
                "Pelvis",
                "Spine"
            ],
            "mri" => [
                "Brain",
                "Spine",
                "Knee",
                "Shoulder",
                "Abdomen"
            ]
        ]);
    }

    /**
     * Store the medical test data and send an email notification.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                "patient_name" => 'required|string|max:255',
                "x_ray" => "array",
                "x_ray.*" => "in:Chest,Cervical Vertebrae,Thoracic Vertebrae,Lumbar Vertebrae,Lumbo Sacral Vertebrae,Thoraco Lumbar Vertebrae,Shoulder Joint,Elbow Joint,Wrist Joint,Knee Joint,Pelvic Joint",
                "ultrasound_scan" => "array",
                "ultrasound_scan.*" => "in:Obstetric,Abdominal,Pelvis,Prostate,Breast,Thyroid",
                "ct_scan" => "array",
                "ct_scan.*" => "in:Head,Chest,Abdomen,Pelvis,Spine",
                "mri" => "array",
                "mri.*" => "in:Brain,Spine,Knee,Shoulder,Abdomen"
            ]);

            // Attempt to send the email notification
            Mail::to("talk2ata@gmail.com")->send(new PatientUpdateMail(
                $validatedData["patient_name"],
                $validatedData["x_ray"] ?? [],
                $validatedData["ultrasound_scan"] ?? [],
                $validatedData["ct_scan"] ?? [],
                $validatedData["mri"] ?? []
            ));

            // Return a success response
            return response()->json(["message" => "Medical data submitted successfully"], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);

        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An internal server error occurred'], 500);
        }
    }
}
