<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('root:create', function () {
    $this->comment('Creating root user...');

    User::create([
        'username' => 'root',
        'email' => 'root@user.account',
        'password' => 'admin',
    ]);

    $user = User::where('username', 'root')->first();
    $user->role = 0;
    $user->save();

    $this->comment('Root user created. Root password is "admin". Please change it immediately.');
    $this->comment('Root email: root@user.account');
    $this->comment('Root password: admin');
})->purpose('Create the root user');

Artisan::command('root:change', function () {
    $this->comment('Changing root password...');

    $password = Str::random(32);

    $user = User::where('username', 'root')->first();
    $user->password = $password;
    $user->save();

    $this->comment('Root password changed. New password is: ' . $password);
})->purpose('Change the root password');
