<?php

namespace App;



class Applicant_Detail extends Model
{
    public function Applicant_Contact() {
    	return $this->hasOne('App\Applicant_Contact', 'id_contact', 'id_detail');
    }

    public function scopeGetDetail($query, $var) {
    	return $this->where('id_contact', '=', $var);
    }

    public function scopeGetFirstResume($query, $var) {
    	return $this->select('resume_location')->where('id_contact', '=', $var);
    }

    public function scopeGetUpdatedResume($query, $var) {
    	return $this->select('updated_resume')->where('id_contact', '=', $var);
    }
}
