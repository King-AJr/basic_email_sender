<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PatientUpdateMail;
use App\Models\LaboratoryTest;
use App\Models\MedicalRecord;
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
        try {
            // Define the categories
            $categories = [
                "xray" => [],
                "ultrasound_scan" => [],
                "ct_scan" => [],
                "mri" => []
            ];

            // Fetch all laboratory tests
            $tests = LaboratoryTest::all();

            // Group tests by their categories
            foreach ($tests as $test) {
                switch ($test->category) {
                    case 'x_ray':
                        $categories['x_ray'][] = $test->name;
                        break;
                    case 'ultrasound_scan':
                        $categories['ultrasound_scan'][] = $test->name;
                        break;
                    case 'ct_scan':
                        $categories['ct_scan'][] = $test->name;
                        break;
                    case 'mri':
                        $categories['mri'][] = $test->name;
                        break;
                    default:
                        break;
                }
            }

            // Return the grouped data as a JSON response
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An internal server error occurred'], 500);
        }
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

            // Create the medical record and save it to the database
            $medical_record = MedicalRecord::create([
                "patient_name" => $validatedData["patient_name"],
                "xray" => $validatedData["x_ray"] ?? [],
                "ultrasound" => $validatedData["ultrasound_scan"] ?? [],
                "ct_scan" => $validatedData["ct_scan"] ?? [],
                "mri" => $validatedData["mri"] ?? []
            ]);

            $medical_record->save();


            // Attempt to send the email notification
            Mail::to(env('MAIL_TO'))->send(new PatientUpdateMail(
                $validatedData["patient_name"],
                $validatedData["x_ray"] ?? [],
                $validatedData["ultrasound_scan"] ?? [],
                $validatedData["ct_scan"] ?? [],
                $validatedData["mri"] ?? []
            ));

            // Return a success response
            return $medical_record;
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ' . $e->getMessage());
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'An internal server error occurred'], 500);
        }
    }
}
