<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function application(){
        return $this->hasMany(JobApplication::class, 'job_listing_id');
    }

    public function carbonDate()
    {
        return Carbon::parse($this->created_at)->format('d M, Y');
    }

    public function scopeApproved($query)
    {
        return $query->where([
            'status' => 1,
        ]);
    }

    public function scopeFeatured($query)
    {
        return $query->where([
            'featured' => 1,
        ]);
    }
}
