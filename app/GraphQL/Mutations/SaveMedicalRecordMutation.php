<?php


namespace App\GraphQL\Mutations;

use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Validator;
use GraphQL\Error\Error;


class SaveMedicalRecordMutation
{
    public function __invoke($_, array $args)
    {
        \Log::info('Received input:', $args['input']);

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

        // Example of additional checks or processing
        // Ensure that at least one of the tests has been provided
        if (empty($args['input']['xray']) &&
            empty($args['input']['ultrasound']) &&
            empty($args['input']['ct_scan']) &&
            empty($args['input']['mri'])) {
            throw new Error('At least one test result must be provided.');
        }

        // Save the medical record to the database
        return MedicalRecord::create($args['input']);
    }
}
