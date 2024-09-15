<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;

class AdminCalendarController extends Controller
{
    public function index(){
        $calendars = Calendar::all();
        return view('admin.calendar.calendar', compact('calendars'));
    }
    public function createCalendar(){
        return view('admin.appointment.appointment');
    }
    
    public function storeCalendar(Request $request)
    {
        $request->validate([
            'appointmentdate' => 'required|date',
            'appointmenttime' => 'required|date_format:H:i',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^0[0-9]{10}$/',
            'email' => 'required|string|lowercase|email|max:255',
            'medicalhistory' => 'nullable|string',
            'emergencycontactname' => 'required|string|max:255',
            'emergencycontactrelation' => 'required|string',
            'emergencycontactphone' => 'required|string|regex:/^0[0-9]{10}$/',
            'name' => 'nullable|string|max:255',
            'relation' => 'nullable|string',
        ]);

        Calendar::create([
            'appointmentdate' => $request->input('appointmentdate'),
            'appointmenttime' => $request->input('appointmenttime'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'birthday' => $request->input('birthday'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'medicalhistory' => $request->input('medicalhistory'),
            'emergencycontactname' => $request->input('emergencycontactname'),
            'emergencycontactrelation' => $request->input('emergencycontactrelation'),
            'emergencycontactphone' => $request->input('emergencycontactphone'),
            'name' => $request->input('name'),
            'relation' => $request->input('relation'),
        ]);

        return redirect()->route('appointment')->with('success', 'Appointment added successfully!');
    }
    public function deleteCalendar($id){
        $calendar = Calendar::findOrFail($id);
        $calendar->delete();

        return back()
            ->with('success', 'Appointment deleted successfully!');
    }

    public function updateCalendar($id){
        $calendar = Calendar::findOrFail($id);
        return view('admin.calendar.updateCalendar')->with('calendar', $calendar);
    }

    public function updatedCalendar(Request $request, $id){

        $calendar = Calendar::findOrFail($id);
        
        $request->validate([
            'appointmentdate' => 'required|date',
            'appointmenttime' => 'required|date_format:H:i',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^0[0-9]{10}$/',
            'email' => 'required|string|lowercase|email|max:255',
            'medicalhistory' => 'nullable|string',
            'emergencycontactname' => 'required|string|max:255',
            'emergencycontactrelation' => 'required|string',
            'emergencycontactphone' => 'required|string|regex:/^0[0-9]{10}$/',
            'name' => 'nullable|string|max:255',
            'relation' => 'nullable|string',
        ]);

        $calendar->update([
            'appointmentdate' => $request->input('appointmentdate'),
            'appointmenttime' => $request->input('appointmenttime'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'birthday' => $request->input('birthday'),
            'gender' => $request->input('gender'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'medicalhistory' => $request->input('medicalhistory'),
            'emergencycontactname' => $request->input('emergencycontactname'),
            'emergencycontactrelation' => $request->input('emergencycontactrelation'),
            'emergencycontactphone' => $request->input('emergencycontactphone'),
            'name' => $request->input('name'),
            'relation' => $request->input('relation'),
        ]);

        return redirect()->route('admin.calendar')
            ->with('success', 'Appointment updated successfully!');
    }
}
