<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Account;
use App\Helpers\Account\AccountFacade;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    /**
     * @param Account $account
     * @return JsonResponse
     */
    public function show(Account $account): JsonResponse
    {
        return $this->makeResponse([
            'account' => AccountFacade::getDTO($account)->toArray(),
        ]);
    }
}
