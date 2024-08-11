<?php

namespace App\GraphQL\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use DateTime;

class DateTimeScalar extends ScalarType
{
    public $name = 'DateTime';

    public function serialize($value)
    {
        if ($value instanceof DateTime) {
            return $value->format(DateTime::ISO8601);
        }

        throw new Error('Invalid value provided for DateTime scalar.');
    }

    public function parseValue($value)
    {
        try {
            return new DateTime($value);
        } catch (\Exception $e) {
            throw new Error('Invalid value provided for DateTime scalar.');
        }
    }

    public function parseLiteral($valueNode, $variables = null)
    {
        if ($valueNode->kind === 'StringValue') {
            try {
                return new DateTime($valueNode->value);
            } catch (\Exception $e) {
                throw new Error('Invalid value provided for DateTime scalar.');
            }
        }

        throw new Error('Invalid value provided for DateTime scalar.');
    }
}
