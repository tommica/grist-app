<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

Artisan::command('grist:change_root_user_pass', function () {
    $user = User::first();

    if($user->password_changed_at) {
        $this->comment('Password has already been changed');
        return 0;
    }

    $pass = $this->secret("New password");
    $user->update([
        'password' => Hash::make($pass),
        'password_changed_at' => now(),
    ]);
    $this->comment('Password was changed succesfully');
})->purpose('Change the root users password');
