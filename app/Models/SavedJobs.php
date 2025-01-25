<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SavedJobs extends Model
{
    public function job(){
        return $this->belongsTo(JobListing::class, 'job_listing_id');
    }

    public function carbonDate(){
        return Carbon::parse($this->created_at)->format('d M, y');
    }
}
