<?php

use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(User::class, 4)
            ->create()
            ->each(function ($user) {
                /* @var User $user */
                $user->tickets()
                    ->save(factory(Ticket::class)->make());
            });
    }
}
