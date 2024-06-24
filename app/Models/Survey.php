<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'surveys';
    protected $fillable = [
        'date',
        'title',
        'note',
    ];

    public function getStateAttribute($value)
    {
        return $value == 0 ? 'public' : 'private';
    }

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = $value == 'public' ? '0' : '1';
    }
}
