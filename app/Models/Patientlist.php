<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patientlist extends Model
{
    protected $fillable = ['firstname', 'lastname', 'gender', 'birthday', 'age', 'phone', 'address', 'email'];
    
    
    public function records()
    {
        return $this->hasMany(Record::class, 'patientlist_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'patientlist_id');
    }

}

