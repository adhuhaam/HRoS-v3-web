<?php

// app/Http/Controllers/UserManagementController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function create()
    {
        $roles = ['agent', 'client']; // only allow these roles here
        return view('settings.addagentandclients', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:agent,client'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'User created and role assigned successfully.');
    }

    public function listAgentsAndClients()
    {
        $agents = User::role('agent')->get();
        $clients = User::role('clients')->get(); // assuming role is called 'clients'

        return view('settings.viewagentsandclients', compact('agents', 'clients'));
    }
}
