<?php

namespace App\Models;

use App\Models\Patients;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'desired_date',
        'desired_time',
        'specialty',
        'comments',
        'status',
        'patient_id',
    ];
    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }
}