<?php

namespace App;

use App\Helpers\Transaction\TransactionFacade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int id
 * @property string name
 * @property float balance
 */
class Account extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'balance'
    ];

    /**
     * @return Transaction[]
     */
    public function transactions(): iterable
    {
        return Transaction::where('from', $this->id)
            ->orWhere('to', $this->id)
            ->latest()
            ->get();
    }

    /**
     * @return string
     */
    public function getCacheVariable(): string
    {
        return "transaction_of_" . $this->id;
    }

    /**
     * @return void
     */
    public function cacheTransactions(): void
    {
        Cache::put(
            $this->getCacheVariable(),
            $this->transactions()
                ->map(function (Transaction $transaction) {
                    return TransactionFacade::getDTO($transaction);
                })->toArray()
        );
    }
}
