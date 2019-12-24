<?php

/** @var Factory $factory */

use App\Models\Ticket;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Ticket::class,
    function (Faker $faker) {
        return [
            'title' => $faker->text(50),
            'priority' => array_rand(Ticket::getPriorities()),
            'status' => array_rand(Ticket::getStatuses()),
        ];
    });
