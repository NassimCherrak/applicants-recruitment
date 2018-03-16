<?php

namespace App;

class Applicant_Contact extends Model
{
    public function scopeJoinADetails($query) {
        return $query->select('*')->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact');
    }

    public function scopeJoinEDetails($query) {
        return $query->select('*')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact');
    }

    public function scopeGetApplicant($query, $val) {
    	return $query->where('applicant__contacts.id_contact', $val);
    }

    public function scopeGetApplicantID($query, $val) {
    	return $query->where('id_contact', $val);
    }

    public function scopeSearchFirstName($query, $val) {
        return $query->where('first_name', 'LIKE', '%'.$val.'%');
    }

    public function scopeSearchLastName($query, $val) {
        return $query->where('last_name', 'LIKE', '%'.$val.'%');
    }

    public function scopeGetStatus($query, $val) {
        return $query->select('applicant__contacts.id_contact','first_name','last_name')->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->where('applicant__details.status', '=', $val);
    }

    public function scopeGetProgramStatus($query, $val) {
        return $query->select('applicant__contacts.id_contact','first_name','last_name')->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->where('applicant__details.program_status', '=', $val);
    }

    public function scopeGetAppointmentDate($query, $val) {
        return $query->select('*')->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->where('applicant__details.date', '=', $val);
    }

    public function scopeDisplayAll($query) {
        return $query->select('*')->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact');
    }

    public function Applicant_Detail() {
    	return $this->belongsTo('App\Applicant_Detail');
    }

    public function Employee_Detail() {
    	return $this->belongsTo('App\Employee_Detail');
    }
}
