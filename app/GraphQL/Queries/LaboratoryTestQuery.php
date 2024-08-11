<?php

namespace App\GraphQL\Queries;

use App\Models\LaboratoryTest;

class LaboratoryTestQuery
{
    public function __invoke($_, array $args)
    {
        // Check if the 'category' argument is provided
        if (isset($args['category'])) {
            // Filter tests by the provided category
            return LaboratoryTest::where('category', $args['category'])->get();
        }

        // Return all tests if no category is provided
        return LaboratoryTest::all();
    }
}
