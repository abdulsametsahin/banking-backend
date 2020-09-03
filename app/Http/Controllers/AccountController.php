<?php

namespace App\Http\Controllers;

use App\Account;
use App\Helpers\Account\AccountFacade;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function show(Account $account)
    {
        return $this->makeResponse([
            'account' => AccountFacade::getDTO($account)->toArray(),
        ]);
    }
}
