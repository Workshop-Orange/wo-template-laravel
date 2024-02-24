<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link',
        'date_applied',
        'salary_annual_min',
        'salary_annual_max',
        'salary_currency',
        'job_application_company_id',
        'job_application_role_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_applied' => 'datetime',
        'job_application_company_id' => 'integer',
        'job_application_role_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function getSalaryRangeAttribute()
    {
        return [
            $this->salary_annual_min ?? 0,
            $this->salary_annual_max ?? 0
        ];
    }

    public function getAgeAttribute()
    {
        if(isset($this->date_applied)) {
            return Carbon::now()->sub($this->date_applied)->diffForHumans();
        }

        return "";
    }
    
    public function getFullJobApplicationTitleAttribute()
    {   
        $company = $this->jobApplicationCompany;
        $role = $this->jobApplicationRole;
        
        if($company && $role) {
            return $role->title . " @ " . $company->title;
        }

        if($company) {
            return $company->title;
        }

        if($role) {
            return $role->title;
        }
        
        return "Job application";
    }

    public function jobApplicationFields(): HasMany
    {
        return $this->hasMany(JobApplicationField::class);
    }

    public function jobApplicationCompany(): BelongsTo
    {
        return $this->belongsTo(JobApplicationCompany::class);
    }

    public function jobApplicationRole(): BelongsTo
    {
        return $this->belongsTo(JobApplicationRole::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
