<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function jobs()
    {
        return $this->hasMany(JobListing::class, 'category_id', 'id');
    }
    
    public function carbonDate()
    {
        return Carbon::parse($this->created_at)->format('d M, y');
    }
}
