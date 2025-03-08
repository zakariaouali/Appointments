<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patients extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'full_name',
        'birthdate',
        'email',
        'phone',
        'created_at	',
        'updated_at',
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}