<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use DateTime;

use App\Applicant_Contact;
use App\Applicant_Detail;
use App\Employee_Detail;
use App\User;

class ListWord extends Controller
{
	public function createApplicantsList() {

		$this->validate(request(), [
			'date'   => 'required',
		]);

		$datestr = date('Y-m-d', strtotime(request('date')));

		$date = Carbon::createFromFormat('Y-m-d', $datestr);

        //$next_applicants = Applicant_Contact::getAppointmentDate(strtotime($date))->get();

		$next_applicants = Applicant_Contact::getAppointmentDate($datestr);

		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$phpWord->setDefaultParagraphStyle(array('spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)));

		$section = $phpWord->addSection();

		$titleStyle15 = 'tStyle15';
		$titleStyle12 = 'tStyle12';
		$phpWord->addFontStyle($titleStyle15, array('bold' => true, 'size' => 15));
		$phpWord->addFontStyle($titleStyle12, array('bold' => true, 'size' => 12));

		$fancyTableStyleName = 'Fancy Table';
		$fancyTableStyle = array('borderSize' => 6, 'cellMargin' => 50, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 50);
		$fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => 'E6E6E6');
		$fancyTableCellStyle = array('valign' => 'center');
		$fancyTableFontStyle = array('bold' => true);
		$hCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);

		$section->addTextRun($hCentered)->addText('SIMPACT Information Session', $titleStyle15);
		$section->addTextRun($hCentered)->addText('Registration', $titleStyle15);

		$section->addText();

		$section->addTextRun($hCentered)->addText('Simpact-16775 Yonge Street, Newmarket, ON', $titleStyle12);
		$section->addTextRun($hCentered)->addText('Date: '.$date->toFormattedDateString(), $titleStyle15);
		$section->addTextRun($hCentered)->addText('9:00am – 12:00pm', $titleStyle15);
		$section->addTextRun($hCentered)->addText('Main Boardroom', $titleStyle15);

		$section->addText();

		$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
		$table = $section->addTable($fancyTableStyleName);
		$table->addRow(400);
		$table->addCell(2000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Participant Name', $fancyTableFontStyle);
		$table->addCell(1500, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Phone #', $fancyTableFontStyle);
		$table->addCell(2000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Email Address', $fancyTableFontStyle);
		$table->addCell(1500, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Date Booked', $fancyTableFontStyle);
		$table->addCell(500, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Resume', $fancyTableFontStyle);
		$table->addCell(1000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Specialist', $fancyTableFontStyle);

		$num_of_rows = $next_applicants->count();

		foreach($next_applicants->get() as $applicant) {
			$table->addRow(400);
			$table->addCell(500)->addText($applicant->first_name." ".$applicant->last_name);
			$table->addCell(500)->addText($applicant->phone);
			$table->addCell(500)->addText($applicant->email);
			$table->addCell(500)->addText(date('Y-m-d', strtotime($applicant->created_at)));

			$resume = '';
			if($applicant->resume_location == 'Default' or $applicant->resume_location == '') {
				$resume = 'No';
			} else {
				$resume = 'Yes';
			}
			$table->addCell(500)->addText($resume);

			$employer = User::select('name')->where('id','=',$applicant->id_employer)->get();

			$employer_name = "";

			if($employer->count() > 0) {
				$employer_name = $employer[0]->name;
			}

			$table->addCell(100)->addText($employer_name);
		}
		
		if($num_of_rows < 16) {
			$empty_rows = 16 - $num_of_rows;
			for ($i = 1; $i <= $empty_rows; $i++) {
				$table->addRow(400);
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
			}
		}

		$objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

		try {
			$objectWriter->save(storage_path('Appointment.docx'));
		} catch(Exception $e) {}

		return response()->download(storage_path('Appointment.docx'));
	}

	public function displayAllList() {
		$allApplicants = $allParticipants = Applicant_Contact::displayAll();

		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$phpWord->setDefaultParagraphStyle(array('spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0)));

		$section = $phpWord->addSection();

		$date = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime(now())));

		$titleStyle12 = 'tStyle12';
		$titleStyle9 = 'tStyle9';
		$phpWord->addFontStyle($titleStyle12, array('bold' => true, 'size' => 12));
		$phpWord->addFontStyle($titleStyle9, array('bold' => false, 'size' => 9));

		$fancyTableStyleName = 'Fancy Table';
		$fancyTableStyle = array('borderSize' => 6, 'cellMargin' => 50, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'cellSpacing' => 50);
		$fancyTableFirstRowStyle = array('borderBottomSize' => 18, 'borderBottomColor' => '0000FF', 'bgColor' => 'E6E6E6');
		$fancyTableCellStyle = array('valign' => 'center');
		$fancyTableFontStyle = array('bold' => true);
		$hCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);

		$section->addTextRun($hCentered)->addText('SIMPACT Applicants List', $titleStyle12);

		$section->addTextRun($hCentered)->addText($date->toFormattedDateString(), $titleStyle12);

		$section->addText();

		$phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
		$table = $section->addTable($fancyTableStyleName);
		$table->addRow(400);
		$table->addCell(2000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Participant Name', $fancyTableFontStyle);
		$table->addCell(1000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Department', $fancyTableFontStyle);
		$table->addCell(2000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Status', $fancyTableFontStyle);
		$table->addCell(2000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Program', $fancyTableFontStyle);
		$table->addCell(1000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Appointment', $fancyTableFontStyle);
		$table->addCell(1500, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Start', $fancyTableFontStyle);
		$table->addCell(1000, $fancyTableCellStyle)->addTextRun($hCentered)->addText('Departure', $fancyTableFontStyle);

		$num_of_rows = $allApplicants->count();

		foreach($allApplicants->get() as $applicant) {
			$table->addRow(400);
			$table->addCell(500)->addText($applicant->first_name." ".$applicant->last_name, $titleStyle9);
			$table->addCell(500)->addText($applicant->department, $titleStyle9);
			$table->addCell(500)->addText($applicant->status, $titleStyle9);
			$table->addCell(500)->addText($applicant->program_status, $titleStyle9);
			$table->addCell(500)->addText(date('Y-m-d', strtotime($applicant->date)), $titleStyle9);
			$table->addCell(500)->addText(date('Y-m-d', strtotime($applicant->start_date)), $titleStyle9);
			$table->addCell(500)->addText(date('Y-m-d', strtotime($applicant->end_date)), $titleStyle9);
		}

		if($num_of_rows < 16) {
			$empty_rows = 16 - $num_of_rows;
			for ($i = 1; $i <= $empty_rows; $i++) {
				$table->addRow(400);
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
				$table->addCell(500)->addText("");
			}
		}

		$objectWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');

		try {
			$objectWriter->save(storage_path('All Participants.docx'));
		} catch(Exception $e) {}

		return response()->download(storage_path('All Participants.docx'));
	}
}
