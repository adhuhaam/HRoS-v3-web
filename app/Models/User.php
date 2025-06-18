<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Vacancies assigned to this user (as an agent).
     */
    public function assignedVacancies()
    {
        return $this->hasMany(Vacancy::class, 'agent_id');
    }

    /**
     * Vacancies created by this user (as HR).
     */
    public function createdVacancies()
    {
        return $this->hasMany(Vacancy::class, 'created_by');
    }

    /**
     * Candidates submitted by this user (as an agent).
     */
    public function candidates()
    {
        return $this->hasMany(Candidate::class, 'agent_id');
    }
}
