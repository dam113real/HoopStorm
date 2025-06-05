<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtletheImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'atlethe_id',
        'image',];
    function atlethe()
    {
        return $this->belongsTo(Atlethe::class);
    }
}
