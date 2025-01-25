<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;

    public function job(){
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function carbonDate(){
        return Carbon::parse($this->created_at)->format('d M, y');
    }
}
