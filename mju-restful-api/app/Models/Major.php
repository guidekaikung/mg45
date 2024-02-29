<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $primaryKey = 'major_id';

    public function student()
    {
        return $this->hasMany(MjuStudent::class,'major_id');
    }
}
