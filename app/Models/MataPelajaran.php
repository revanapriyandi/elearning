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
            return $this->image ? asset('storage/mapel/' . $this->image) : 'https://unair.ac.id/wp-content/uploads/2023/04/gambar1-19-1-1024x929.jpg';
        });
    }

    public function materi()
    {
        return $this->hasMany(Materi::class, 'mata_pelajaran_id');
    }

    public function tugasQuiz()
    {
        return $this->hasMany(TugasQuiz::class, 'mata_pelajaran_id');
    }
}
