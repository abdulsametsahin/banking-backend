<?php

declare(strict_types=1);

namespace App\Helpers\Account;

use App\Account;

class AccountFacade
{
    public static function getDTO(Account $account): AccountDTO
    {
        return new AccountDTO($account->id, $account->name, floatval($account->balanace));
    }
}
