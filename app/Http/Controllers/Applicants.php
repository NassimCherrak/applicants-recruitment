<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use App\Applicant_Contact;
use App\Applicant_Detail;
use App\Employee_Detail;


class Applicants extends Controller
{
    public function index() {

    	return view('applicants.index');
    }

    public function appointment() {

        $contacts = Applicant_Contact::getStatus('New')->get();

        return view('applicants.appointments.appointment', compact('contacts'));
    }

    public function newParticipant() {

        $contacts = Applicant_Contact::getStatus('New')->get();

        return view('applicants.participants.new_applicants', compact('contacts'));
        
    }

    public function hired() {

        $contacts = Applicant_Contact::getStatus('Hired')->get();

        return view('applicants.participants.hired', compact('contacts'));
        
    }

    public function noShow() {

        $contacts = Applicant_Contact::getStatus('No Show')->get();

        return view('applicants.participants.noshow', compact('contacts'));
        
    }

    public function completed() {

        $contacts = Applicant_Contact::getProgramStatus('Program Completed')->get();

        return view('applicants.participants.programcompleted', compact('contacts'));
        
    }

    public function notHired() {

        $contacts = Applicant_Contact::getStatus('Not Hired')->get();

        return view('applicants.participants.nothired', compact('contacts'));
        
    }

    public function pNotCompleted() {

        $contacts = Applicant_Contact::getProgramStatus('Program Not Completed')->get();

        return view('applicants.participants.pnotcompleted', compact('contacts'));
        
    }

    public function onHold() {

        $contacts = Applicant_Contact::getStatus('On Hold')->get();

        return view('applicants.participants.onhold', compact('contacts'));
        
    }

    public function archive() {

    	return view('applicants.archived.archived');
    }

    public function success($address) {

        return view('applicants.layouts.success', compact('address'));
    }

    /**
    *   function to save a new appointment
    */
    public function storeApp(Request $request) {

    	$this->validate(request(), [
    		'first_name'  => 'required',
    		'last_name'   => 'required',
    		'email'       => 'required',
    		'phone'       => 'required',
            'department'  => 'required',
            //'resume'      => 'required',
            'date'        => 'required'
        ]);

        $resume_location = 'Default';

        if($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = $file->getClientOriginalName();

            $resume_location = $filename;

            Storage::disk('resumes')->put($filename, file_get_contents($file));
        }

        $interview_date = date('Y-m-d', strtotime(request('date')));

        $fk_contact = Applicant_Contact::create(request(['first_name', 'last_name', 'email', 'phone']));

        $default_employer = 0;

        $employer = Auth::user()->id;

        $details = array(
            'id_contact'=> $fk_contact->id,
            'date'=> $interview_date,
            'status'=> 'New',
            'program_status' => 'Not Started',
            'resume_location'=> $resume_location,
            'updated_resume' => 'Default',
            'id_employer' => $employer
        );

        $employee = array(
            'id_contact' => $fk_contact->id,
            'department' => request('department')
        );

        Applicant_Detail::create($details);
        Employee_Detail::create($employee);

        return redirect('/success/appointment');
    }

    /**
    *   function to display an existing appointment
    */
    public function updateApp() {

        $selectedContact = null;

        $contacts = Applicant_Contact::getStatus('New')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedContact = Applicant_Contact::getApplicant($selectResult)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedContact = $allSelectedContact[0];

        return view('applicants.appointments.appointment', compact('contacts', 'selectedContact'));
    }


    /**
    *   function to update the information of an existing appointment
    */
    public function overrideApp($id, Request $request) {

        $this->validate(request(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'email'       => 'required',
            'phone'       => 'required',
            'department'  => 'required',
            'date'        => 'required'
        ]);

        $resume_location = 'Default';

        if($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = $file->getClientOriginalName();

            $resume_location = $filename;

            Storage::disk('resumes')->put($filename, file_get_contents($file));
        }

        $interview_date = date('Y-m-d', strtotime(request('date')));

        $current = Applicant_Contact::getApplicantID($id);

        $current->update([
            'last_name' => request('last_name'),
            'first_name' => request('first_name'),
            'email' => request('email'),
            'phone' => request('phone')
        ]);

        $d_current = Applicant_Detail::getDetail($id);

        $default_employer = 0;

        $d_current->update([
            'date' => $interview_date,
            'resume_location' => $resume_location,
            'updated_resume' => 'Default',
            'id_employer' => $default_employer
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $e_current->update([
            'department' => request('department')
        ]);

        return redirect('/success/appointment');
    }

    /**
    *   function to save the data for a new participant
    */

    public function storePart($id) {
        $this->validate(request(), [
            'status'    => 'required',
            'first_name'  => 'required',
            'last_name'   => 'required',
            'email'       => 'required',
            'phone'       => 'required'
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $d_current = Applicant_Detail::getDetail($id);

        $start_date = date('Y-m-d', strtotime(request('date')));

        if(request('status') == 'Hired') {
            $e_current->update([
                'start_date' => $start_date,
                'end_date' => date_add(Carbon::createFromFormat('Y-m-d' ,$start_date), date_interval_create_from_date_string('8 weeks')),
                'shift' => request('shift'),
                'department' => request('department'),
                'title' => request('title')
            ]);
            $d_current->update([
                'program_status' => 'Ongoing'
            ]);
        }

        $e_current->update([
            'comment' => request('comment')
        ]);
        
        $d_current->update([
            'status' => request('status')
        ]);

        return redirect('/success/new-participant');
    }

    /**
    *   function to display an existing participant
    */
    public function updatePart() {

        $selectedParticipant = null;

        $contacts = Applicant_Contact::getStatus('New')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedParticipant = Applicant_Contact::getApplicant($selectResult)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedParticipant = $allSelectedParticipant[0];

        return view('applicants.participants.new_applicants', compact('contacts', 'selectedParticipant'));
    }

    /**
    *   function to update the data of a hired participant
    */
    public function storeHired($id, Request $request) {

        $this->validate(request(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'       => 'required',
            'email'       => 'required',
            'title'       => 'required'
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $d_current = Applicant_Detail::getDetail($id);

        $c_current = Applicant_Contact::getApplicantID($id);

        $end_date = date('Y-m-d', strtotime(request('date')));

        if($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = $file->getClientOriginalName();

            $filename = $id.$filename; 

            $resume_location = $filename;

            Storage::disk('resumes')->put($filename, file_get_contents($file));

            $d_current->update([
                'updated_resume' => $resume_location
            ]);
        }

        $e_current->update([
            'end_date' => $end_date,
            'shift' => request('shift'),
            'department' => request('department'),
            'title' => request('title'),
            'comment' => request('comment')
        ]);

        if(request('program-status') != 'please select the program status') {
            $d_current->update([
                'program_status' => request('program-status')
            ]);
        }
        
        if(request('status') != 'Select Status') {
            $d_current->update([
                'status' => request('status')
            ]);
        }

        $c_current->update([
            'first_name'  => request('first_name'),
            'last_name'   => request('last_name'),
            'phone'       => request('phone'),
            'email'       => request('email')
        ]);

        return redirect('/success/hired');
    }

    /**
    *   function to display the data of a hired participant
    */
    public function updateHired() {

        $selectedParticipant = null;

        $contacts = Applicant_Contact::getStatus('Hired')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedParticipant = Applicant_Contact::getApplicant($selectResult)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedParticipant = $allSelectedParticipant[0];

        return view('applicants.participants.hired', compact('contacts', 'selectedParticipant'));
    }

    /**
    *   function to update the data or change the status of a no show
    */
    public function storeNoShow($id) {
        $this->validate(request(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'       => 'required',
            'email'       => 'required'
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $d_current = Applicant_Detail::getDetail($id);

        $c_current = Applicant_Contact::getApplicantID($id);

        $appointment_date = date('Y-m-d', strtotime(request('date')));

        $e_current->update([
            'comment' => request('comment')
        ]);

        if(request('status') == 'New') {
            $d_current->update([
                'date'   => $appointment_date,
                'status' => request('status')
            ]);
        }

        $c_current->update([
            'first_name'  => request('first_name'),
            'last_name'   => request('last_name'),
            'phone'       => request('phone'),
            'email'       => request('email')
        ]);

        return redirect('/success/noshow');
    }

    /**
    *   function to display the data of a no show applicant
    */
    public function updateNoShow() {
        $selectedParticipant = null;

        $contacts = Applicant_Contact::getStatus('No Show')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedParticipant = Applicant_Contact::getApplicant($selectResult)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedParticipant = $allSelectedParticipant[0];

        return view('applicants.participants.noshow', compact('contacts', 'selectedParticipant'));
    }

    /**
    *   function to update the information of an applicant who completed the program
    */
    public function storePCompleted($id, Request $request) {
        $this->validate(request(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'       => 'required',
            'email'       => 'required'
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $d_current = Applicant_Detail::getDetail($id);

        $c_current = Applicant_Contact::getApplicantID($id);

        $end_date = date('Y-m-d', strtotime(request('date')));

        if($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = $file->getClientOriginalName();

            $filename = $id.$filename; 

            $resume_location = $filename;

            Storage::disk('resumes')->put($filename, file_get_contents($file));

            $d_current->update([
                'updated_resume' => $resume_location
            ]);
        }

        $e_current->update([
            'end_date'   => $end_date,
            'comment' => request('comment')
        ]);

        $d_current->update([
            'status' => request('status')
        ]);

        $c_current->update([
            'first_name'  => request('first_name'),
            'last_name'   => request('last_name'),
            'phone'       => request('phone'),
            'email'       => request('email')
        ]);

        return redirect('/success/pcompleted');
    }

    /**
    *   function to display the data of participants who completed the program
    */
    public function updatePCompleted() {
        $selectedParticipant = null;

        $contacts = Applicant_Contact::getProgramStatus('Program Completed')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedParticipant = Applicant_Contact::getApplicant($selectResult)->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedParticipant = $allSelectedParticipant[0];
        return view('applicants.participants.programcompleted', compact('contacts', 'selectedParticipant'));
    }

    /**
    *   function to update the data of an applicant that was not hired
    */
    public function storeNotHired($id) {
        $this->validate(request(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'       => 'required',
            'email'       => 'required'
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $d_current = Applicant_Detail::getDetail($id);

        $c_current = Applicant_Contact::getApplicantID($id);

        $e_current->update([
            'comment' => request('comment')
        ]);

        $c_current->update([
            'first_name'  => request('first_name'),
            'last_name'   => request('last_name'),
            'phone'       => request('phone'),
            'email'       => request('email')
        ]);

        return redirect('/success/nothired');
    }

    /**
    *   function to display the data of an applicant that was not hired
    */
    public function updateNotHired() {
        $selectedParticipant = null;

        $contacts = Applicant_Contact::getStatus('Not Hired')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedParticipant = Applicant_Contact::getApplicant($selectResult)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedParticipant = $allSelectedParticipant[0];

        return view('applicants.participants.nothired', compact('contacts', 'selectedParticipant'));
    }

    /**
    *   function to update the data of a participant who didn't complete the program
    */
    public function storePNotCompleted($id, Request $request) {
        $this->validate(request(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'       => 'required',
            'email'       => 'required'
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $d_current = Applicant_Detail::getDetail($id);

        $c_current = Applicant_Contact::getApplicantID($id);

        $end_date = date('Y-m-d', strtotime(request('date')));

        if($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = $file->getClientOriginalName();

            $filename = $id.$filename; 

            $resume_location = $filename;

            Storage::disk('resumes')->put($filename, file_get_contents($file));

            $d_current->update([
                'updated_resume' => $resume_location
            ]);
        }

        $e_current->update([
            'end_date'   => $end_date,
            'departure_reason'  => request('reason'),
            'comment' => request('comment')
        ]);

        $c_current->update([
            'first_name'  => request('first_name'),
            'last_name'   => request('last_name'),
            'phone'       => request('phone'),
            'email'       => request('email')
        ]);

        return redirect('/success/pnotcompleted');
    }

    /**
    *   function to display the data of a participant who didn't complete the program
    */
    public function updatePNotCompleted() {
        $selectedParticipant = null;

        $contacts = Applicant_Contact::getProgramStatus('Program Not Completed')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedParticipant = Applicant_Contact::getApplicant($selectResult)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedParticipant = $allSelectedParticipant[0];

        return view('applicants.participants.pnotcompleted', compact('contacts', 'selectedParticipant'));
    }

    /**
    *   function to update the data of a participant on hold
    */
    public function storeOnHold($id, Request $request) {
        $this->validate(request(), [
            'first_name'  => 'required',
            'last_name'   => 'required',
            'phone'       => 'required',
            'email'       => 'required'
        ]);

        $e_current = Employee_Detail::getEmployee($id);

        $d_current = Applicant_Detail::getDetail($id);

        $c_current = Applicant_Contact::getApplicantID($id);

        $end_date = date('Y-m-d', strtotime(request('date')));

        if($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = $file->getClientOriginalName();

            $filename = $id.$filename; 

            $resume_location = $filename;

            Storage::disk('resumes')->put($filename, file_get_contents($file));

            $d_current->update([
                'updated_resume' => $resume_location
            ]);
        }

        $e_current->update([
            'comment' => request('comment')
        ]);

        $d_current->update([
            'program_status' => request('program-status')
        ]);

        if(request('status') != 'Select Status') {
            $d_current->update([
                'status' => request('status')
            ]);
        }

        $c_current->update([
            'first_name'  => request('first_name'),
            'last_name'   => request('last_name'),
            'phone'       => request('phone'),
            'email'       => request('email')
        ]);

        return redirect('/success/onhold');
    }

    /**
    *   function to display the data of a participant on hold
    */
    public function updateOnHold() {
        $selectedParticipant = null;

        $contacts = Applicant_Contact::getStatus('On Hold')->get();
        $this->validate(request(), [
            'name-selected'   => 'required',
        ]);

        $selectResult = request('name-selected');

        $allSelectedParticipant = Applicant_Contact::getApplicant($selectResult)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->get();
        $selectedParticipant = $allSelectedParticipant[0];

        return view('applicants.participants.onhold', compact('contacts', 'selectedParticipant'));
    }

    /**
    *   display the basic search page
    */
    public function search() {
        return view('applicants.search.display');
    }

    /**
    *   search the users using the first and last name
    */
    public function searchDisplay() {
        $this->validate(request(), [
            'first_name'  => 'required_without_all:last_name,department,status,program-status',
            'last_name'   => 'required_without_all:first_name,department,status,program-status',
            'department'  => 'required_without_all:last_name,first_name,status,program-status',
            'status'      => 'required_without_all:last_name,first_name,department,program-status',
            'program-status' => 'required_without_all:last_name,first_name,department,status'
        ]);

        $first_name = request('first_name');
        $last_name = request('last_name');
        $department = request('department');
        $status = request('status');
        $program_status = request('program-status');

        $results = null;

        $results = Applicant_Contact::searchLastName($last_name)->searchFirstName($first_name)->join('applicant__details', 'applicant__details.id_contact', '=', 'applicant__contacts.id_contact')->where('status', 'LIKE', $status)->where('program_status', 'LIKE', $program_status)->join('employee__details', 'employee__details.id_contact', '=', 'applicant__contacts.id_contact')->where('department', 'LIKE', $department)->get();
        

        return view('applicants.search.display', compact('results'));
    }

    /**
    *   Display all applicants
    */
    public function displayAll() {
        $allParticipants = Applicant_Contact::displayAll()->paginate(5);

        return view('applicants.all.display', compact('allParticipants'));
    }

    /**
    *   Download first version of the resume
    */
    public function getFirstResume($id) {

        $participant = Applicant_Detail::getFirstResume($id)->get();
        if($participant->count() > 0) {
            $path = storage_path('app/resumes').'/'.$participant[0]->resume_location;
            return response()->download($path);
        }
        return view('applicants.index');
    }

    public function getLastResume($id) {

        $participant = Applicant_Detail::getUpdatedResume($id)->get();
        if($participant->count() > 0) {
            $path = storage_path('app/resumes').'/'.$participant[0]->updated_resume;
            return response()->download($path);
        }
        return view('applicants.index');
    }
}
