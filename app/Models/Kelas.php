<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    public function ImageUrl(): Attribute
    {
        return Attribute::get(function () {
            return $this->image ? asset('storage/uploads') . '/' .  $this->image : 'https://png.pngtree.com/thumb_back/fh260/background/20230315/pngtree-classroom-classroom-illustration-background-image_1948576.jpg';
        });
    }

    public function kelasTugasQuiz()
    {
        return $this->hasMany(KelasTugasQuiz::class, 'kelas_id');
    }
}
