<?php

namespace App;

class Employee_Detail extends Model
{
    public function Applicant_Contact() {
    	return $this->hasOne('App\Applicant_Contact', 'id_contact', 'id_employee');
    }

    public function scopeGetEmployee($query, $var) {
    	return $this->where('id_contact', '=', $var);
    }
}
