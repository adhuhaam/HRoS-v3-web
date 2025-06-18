<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'designation_id',
        'agent_id',
        'created_by',
        'candidate_limit',
        'allow_unlimited',
    ];

    protected $table = 'vacancies';

    /**
     * Get the designation linked to this vacancy.
     */
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    /**
     * Get the agent assigned to this vacancy.
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    /**
     * Get the HR user who created this vacancy.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the candidates linked to this vacancy.
     */
    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
