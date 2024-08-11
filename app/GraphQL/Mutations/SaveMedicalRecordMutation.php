<?php

namespace App\GraphQL\Mutations;

use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\PatientUpdateMail; // Import the Mailable class
use GraphQL\Error\Error;

class SaveMedicalRecordMutation
{
    public function __invoke($_, array $args)
    {
        // Validate the input arrays
        $validator = Validator::make($args['input'], [
            'xray' => 'array|nullable',
            'ultrasound' => 'array|nullable',
            'ct_scan' => 'array|nullable',
            'mri' => 'array|nullable',
        ]);

        // Handle validation failures
        if ($validator->fails()) {
            throw new Error($validator->errors()->first());
        }

        // Ensure that at least one of the tests has been provided
        if (
            empty($args['input']['xray']) &&
            empty($args['input']['ultrasound']) &&
            empty($args['input']['ct_scan']) &&
            empty($args['input']['mri'])
        ) {
            throw new Error('At least one test result must be provided.');
        }

        // Save the medical record to the database
        $medicalRecord = MedicalRecord::create($args['input']);

        // Attempt to send the email notification
        try {
            Mail::to(env('MAIL_TO'))->send(new PatientUpdateMail(
                $args['input']['patient_name'] ?? 'N/A',
                $args['input']['xray'] ?? [],
                $args['input']['ultrasound'] ?? [],
                $args['input']['ct_scan'] ?? [],
                $args['input']['mri'] ?? []
            ));
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return $medicalRecord;
    }
}
