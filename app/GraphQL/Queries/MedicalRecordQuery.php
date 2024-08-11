<?php

namespace App\GraphQL\Queries;

use App\Models\MedicalRecord;
use Illuminate\Support\Facades\DB;

class MedicalRecordQuery
{
    public function __invoke($root, array $args)
    {
        // Check if patient_name is provided
        if (isset($args['patient_name'])) {
            return MedicalRecord::where('patient_name', $args['patient_name'])->get();
        }

        return MedicalRecord::all();
    }
}
