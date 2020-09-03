<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $from = Account::select('id')
        ->inRandomOrder()
        ->first();
    $to = Account::select('id')
        ->inRandomOrder()
        ->where('id', '!=', $from->id)
        ->first();

    return [
        'from' => $from->id,
        'to' => $to->id,
        'amount' => $faker->randomFloat(3, 0, 999999),
        'details' => $faker->text(50)
    ];
});
