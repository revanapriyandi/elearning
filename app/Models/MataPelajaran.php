<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataPelajaran extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['image_url'];

    public function ImageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image ? asset('storage/mapel/' . $this->image) : asset('storage/default.png');
        });
    }
}
