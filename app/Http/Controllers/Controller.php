<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function makeResponse(array $data, array $errors = [], int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'errors' => $errors,
            'success' => in_array($status, [200, 201])
        ]);
    }
}
