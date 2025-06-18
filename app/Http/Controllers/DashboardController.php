<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $dashboards = [
            'super admin' => 'dashboard.superadmin',
            'hr manager'  => 'dashboard.hr',
            'manager'     => 'dashboard.manager',
            'employee'    => 'dashboard.employee',
            'reception'   => 'dashboard.reception',
            'guest'       => 'dashboard.guest',
            'agent'       => 'dashboard.agent',
            'supervisor'  => 'dashboard.supervisor',
            'management'  => 'dashboard.management',
            'clients'     => 'dashboard.clients',
        ];

        foreach ($dashboards as $role => $view) {
            if ($user->hasRole($role)) {
                return view($view);
            }
        }

        // Optional: Log unhandled roles for review
        Log::warning("No dashboard view found for user ID {$user->id} with roles: " . $user->getRoleNames()->implode(', '));

        // Fallback view
        return view('dashboard.default'); // or: abort(403, 'Unauthorized role.');
    }
}
