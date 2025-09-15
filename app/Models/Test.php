<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    protected $fillable = [
        'name',
        'options'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function testDatas(): HasMany
    {
        return $this->hasMany(TestData::class);
    }
}