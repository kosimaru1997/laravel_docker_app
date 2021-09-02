<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function sites(){
        return $this->belongsToMany(Site::class, 'site_tags')->orderBy('created_at', 'DESC');;
    }
}
