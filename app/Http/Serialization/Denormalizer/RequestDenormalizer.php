<?php

namespace App\Http\Serialization\Denormalizer;


interface RequestDenormalizer
{
    /**
     * @return array
     */
    public function attributes(): array;
}
