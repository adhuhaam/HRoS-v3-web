<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = auth()->user();

        $redirectPath = match (true) {
            $user->hasRole('super admin') => '/superadmin/dashboard',
            $user->hasRole('management') => '/management/dashboard',
            $user->hasRole('hr manager'), $user->hasRole('hr staff') => '/hr/dashboard',
            $user->hasRole('manager') => '/manager/dashboard',
            $user->hasRole('supervisor') => '/supervisor/dashboard',
            $user->hasRole('employee') => '/employee/dashboard',
            $user->hasRole('reception') => '/reception/dashboard',
            $user->hasRole('agents') => '/agents/dashboard',
            $user->hasRole('clients') => '/clients/dashboard',
            $user->hasRole('guest') => '/guest/dashboard',
            default => '/',
        };

        return redirect()->intended($redirectPath);
    }
}
