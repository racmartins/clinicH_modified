<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Interfaces\ScheduleServiceInterface;
use App\Http\Requests\StoreAppointment;


use App\Specialty;
use App\Appointment;
use Carbon\Carbon;
use Validator;

class AppointmentController extends Controller
{
    public function create()
    {
	    	$specialties = Specialty::all();
	        $specialtyId = old('specialty_id');
	        if ($specialtyId) {
	            $specialty = Specialty::find($specialtyId);
	            $doctors = $specialty->users;
	        } else {
	            $doctors = collect();
	        }

	        $date = old('scheduled_date');
	        $doctorId = old('doctor_id');
	        if ($date && $doctorId) {
	            $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);
	        } else {
	            $intervals = null;
	        }

	    	return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }
    public function store(StoreAppointment $request)
    {
    	$created = Appointment::createForPatient($request, auth()->id());
        if ($created)
    	   $notification = 'A consulta foi corretamente registada!';
        else
           $notification = 'Ocorreu um problema ao registar a consulta médica.';
    	return back()->with(compact('notification'));
    	// return redirect('/appointments');
    }

}
