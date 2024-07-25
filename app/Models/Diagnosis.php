<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_id',
<<<<<<< HEAD
        'type_id',
        'date',
        'desc',
    ];
    public function record()
    {
        return $this->belongsTo(Record::class,'record_id');
    }
=======
        'desc',
    ];
>>>>>>> 70f0be320d1ad5a027774f1914d8b0d973d3b823
}
