<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Patientlist;
use Illuminate\Http\Request;

class AdminPatientListController extends Controller
{
    public function index(){
        $patientlist = Patientlist::all();
        $patientlist = Patientlist::paginate(10);
        return view('admin.patientlist.patientlist', compact('patientlist'));
    }

    public function createPatient(){
        return view('admin.patientlist.create');
    }

    public function storePatient(Request $request){
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'phone' => 'required|string|regex:/^0[0-9]{10}$/',
            'address' => 'required|string',
            'email' => 'required|string|lowercase|email|max:255',
        ]);

        Patientlist::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'birthday' => $request->input('birthday'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('admin.patientlist')
            ->with('success', 'Patient added successfully!');
    }

    public function deletePatient($id){
        $patient = Patientlist::findOrFail($id);
        $patient->delete();

        return back()
            ->with('success', 'Patient deleted successfully!');
    }

    public function updatePatient($id){
        $patient = Patientlist::findOrFail($id);
        return view('admin.patientlist.updatePatient')->with('patient', $patient);
    }

    public function updatedPatient(Request $request, $id){

        $patient = Patientlist::findOrFail($id);
        
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'phone' => 'required|string|regex:/^0[0-9]{10}$/',
            'address' => 'required|string',
            'email' => 'required|string|lowercase|email|max:255',
        ]);

        $patient->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'birthday' => $request->input('birthday'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('admin.patientlist')
            ->with('success', 'Patient updated successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $patientlist = Patientlist::where('firstname', 'like', "%$query%")
                                ->orWhere('lastname', 'like', "%$query%")
                                ->orWhere('birthday', 'like', "%$query%")
                                ->orWhere('age', 'like', "%$query%")
                                ->orWhere('gender', 'like', "%$query%")
                                ->orWhere('phone', 'like', "%$query%")
                                ->orWhere('address', 'like', "%$query%")
                                ->orWhere('email', 'like', "%$query%")
                                ->paginate(10);

        return view('admin.patientlist.patientlist', compact('patientlist'));
    }
}
