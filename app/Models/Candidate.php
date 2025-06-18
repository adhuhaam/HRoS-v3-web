<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'passport_number',
        'nationality',
        'status',
        'remark',
        'dob',
        'permanent_address',
        'passport_expiration',
        'emergency_contact_name',
        'relation',
        'emergency_contact_number',
        'cv',
        'passport_file',
        'candidate_image',
        'educational_certificates',
        'approved_loa',
        'entry_pass',
        'candidate_signed_loa',
        'last_updated',
        'xpat_designation_id',
        'worksite_id',
        'designation_id',
        'interview_date',
        'interview_time',
        'allocation',
        'last_notified_status',
        'vacancy_id',
        'agent_id',
    ];

    /**
     * Get the vacancy this candidate belongs to.
     */
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    /**
     * Get the agent who submitted this candidate.
     */
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
