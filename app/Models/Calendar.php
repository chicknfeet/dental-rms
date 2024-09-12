<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';

    protected $fillable = [
        'appointmentdate',
        'appointmenttime',
        'firstname',
        'lastname',
        'dateofbirth',
        'gender',
        'address',
        'phone',
        'email',
        'medicalhistory',
        'emergencycontactname',
        'emergencycontactrelation',
        'emergencycontactphone',
        'name',
        'relation',
    ];

}

