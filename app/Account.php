<?php

namespace App;

use App\Helpers\Transaction\TransactionDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int id
 * @property string name
 * @property float balance
 */
class Account extends Model
{
    protected $fillable = [
        'name',
        'balance'
    ];

    public function transactions()
    {
        return Transaction::where('from', $this->id)
            ->orWhere('to', $this->id)
            ->latest()
            ->get();
    }

    public function getCahceVariable()
    {
        return "transaction_of_" . $this->id;
    }

    public function cacheTransactions()
    {
        $transactionDTOs = array_map(function (array $transaction) {
            return new TransactionDTO(
                $transaction['id'],
                $transaction['from'],
                $transaction['to'],
                floatval($transaction['amount']),
                $transaction['details']
            );
        }, $this->transactions()->toArray());
        Cache::put($this->getCahceVariable(), $transactionDTOs);
    }
}
