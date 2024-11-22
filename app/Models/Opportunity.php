<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $fillable = [
        'job_id',
        'title',
        'url',
        'advertiser',
        'location',
        'detail',
        'work_type',
        'salary',
        'posted_at',
        'job_details',
        'last_sent_at',
    ];
}
