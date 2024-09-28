<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body class="min-h-screen">

    <div class="bg-[#4b9cd3;] shadow-[0_2px_4px_rgba(0,0,0,0.4)] py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold mb-10">
        <h4><i class="fa-solid fa-calendar-days"></i> Update Calendar</h4>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('admin.updatedCalendar', $calendar->id) }}" class="grid grid-cols-2 gap-6 bg-white rounded-lg shadow-md p-10">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <div class="grid grid-cols-1 gap-4">
                <div>
                    <h3 class="text-3xl font-bold">Patient Appointment</h3>
                    <p class="text-sm">Fill out the form to schedule your appointment.</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">


                    <div>
                        <label for="appointmentdate" class="font-semibold">Appointment Date</label>
                        <input type="date" class="rounded-lg focus:ring-2 shadow-sm w-full" id="appointmentdate" name="appointmentdate" value="{{ old('appointmentdate', $calendar->appointmentdate) }}" required>
                    </div>

                    <div>
                        <label for="appointmenttime" class="font-semibold time">Appointment Time</label>
                        <input type="time" class="rounded-lg focus:ring-2 shadow-sm w-full" id="appointmenttime" name="appointmenttime" value="{{ old('appointmenttime', $calendar->appointmenttime) }}" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="font-semibold">Name</label>
                        <input type="text" class="rounded-lg focus:ring-2 shadow-sm w-full" id="name" name="name" value="{{ old('name', $calendar->name) }}" required>
                    </div>
                    
                    <div>
                        <label for="gender" class="font-semibold">Gender</label>
                        <select id="gender" name="gender" class="rounded-lg focus:ring-2 shadow-sm w-full" required>
                            <option value="" disabled selected {{ old('gender') ? '' : 'selected' }}>Select your Gender</option>
                            <option value="Male" {{ old('gender', $calendar->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $calendar->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="birthday" class="font-semibold">Birthday</label>
                        <input type="date" class="rounded-lg focus:ring-2 shadow-sm w-full" id="birthday" name="birthday" value="{{ old('birthday', $calendar->birthday) }}" required>
                    </div>
                    
                    
                    <div>
                        <label for="age" class="font-semibold">Age</label>
                        <input type="text" class="rounded-lg focus:ring-2 shadow-sm w-full" id="age" name="age" value="{{ old('age', $calendar->age) }}" required>
                    </div>
                </div>

                <div>
                    <label for="address" class="font-semibold">Address</label>
                    <input type="text" class="rounded-lg focus:ring-2 shadow-sm w-full" id="address" name="address" value="{{ old('address', $calendar->address) }}" required>
                </div>
                    
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="phone" class="font-semibold">Phone No.</label>
                        <input type="tel" class="rounded-lg focus:ring-2 shadow-sm w-full" id="phone" name="phone" value="{{ old('phone', $calendar->phone) }}" required>
                    </div>
                    
                    <div>
                        <label for="email" class="font-semibold">Email</label>
                        <input type="email" class="rounded-lg focus:ring-2 shadow-sm w-full" id="email" name="email" value="{{ old('email', $calendar->email) }}" required>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 gap-4">
                
                <div>
                    <label for="medicalhistory" class="font-semibold">Medical History <span class="text-gray-500">(Optional)</span></label>
                    <input type="text" class="rounded-lg focus:ring-2 shadow-sm w-full" id="medicalhistory" name="medicalhistory" value="{{ old('medicalhistory', $calendar->medicalhistory) }}">
                </div>

                <div>
                    <div>
                        <h1 class="font-semibold text-xl pb-2">Emecgency Contacts</h1>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="emergencycontactname" class="font-semibold">Name</label>
                            <input type="text" class="rounded-lg focus:ring-2 shadow-sm w-full" id="emergencycontactname" name="emergencycontactname" value="{{ old('emergencycontactname', $calendar->emergencycontactname) }}" required>
                        </div>

                        <div>
                            <label for="emergencycontactrelation" class="font-semibold">Relation</label>
                            <select id="emergencycontactrelation" name="emergencycontactrelation" class="rounded-lg focus:ring-2 shadow-sm w-full" required>
                                <option value="" disabled selected {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) ? '' : 'selected' }}>Select your Relation</option>
                                <option value="Grand Father" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Grand Father' ? 'selected' : '' }}>Grand Father</option>
                                <option value="Grand Mother" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Grand Mother' ? 'selected' : '' }}>Grand Mother</option>
                                <option value="Father" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Father' ? 'selected' : '' }}>Father</option>
                                <option value="Mother" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Mother' ? 'selected' : '' }}>Mother</option>
                                <option value="Uncle" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                <option value="Auntie" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Auntie' ? 'selected' : '' }}>Auntie</option>
                                <option value="Son" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Son' ? 'selected' : '' }}>Son</option>
                                <option value="Daughter" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Daughter' ? 'selected' : '' }}>Daughter</option>
                                <option value="Nephew" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Nephew' ? 'selected' : '' }}>Nephew</option>
                                <option value="Niece" {{ old('emergencycontactrelation', $calendar->emergencycontactrelation) === 'Niece' ? 'selected' : '' }}>Niece</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div>
                    <label for="emergencycontactphone" class="font-semibold">Phone No.</label>
                    <input type="tel" class="rounded-lg focus:ring-2 shadow-sm w-full" id="emergencycontactphone" name="emergencycontactphone" value="{{ old('emergencycontactphone', $calendar->emergencycontactphone) }}" required>
                </div>
                    
                <div>
                    <div>
                        <h1 class="font-semibold text-xl pb-3">Fill out this if you're not the patient</h1>
                    </div>
                        
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="relationname" class="font-semibold">Name <span class="text-gray-500">(Optional)</span></label>
                            <input type="text" class="rounded-lg focus:ring-2 shadow-sm w-full" id="relationname" name="relationname" value="{{ old('relationname', $calendar->relationname) }}">
                        </div>

                        <div>
                            <label for="relation" class="font-semibold">Relation <span class="text-gray-500">(Optional)</span></label>
                            <select id="relation" name="relation" class="rounded-lg focus:ring-2 shadow-sm w-full">
                            <option value="" disabled selected {{ old('relation', $calendar->relation) ? '' : 'selected' }}>Select your Relation</option>
                                <option value="Grand Father" {{ old('relation', $calendar->emergencycontactrelation) === 'Grand Father' ? 'selected' : '' }}>Grand Father</option>
                                <option value="Grand Mother" {{ old('relation', $calendar->relation) === 'Grand Mother' ? 'selected' : '' }}>Grand Mother</option>
                                <option value="Father" {{ old('relation', $calendar->relation) === 'Father' ? 'selected' : '' }}>Father</option>
                                <option value="Mother" {{ old('relation', $calendar->relation) === 'Mother' ? 'selected' : '' }}>Mother</option>
                                <option value="Uncle" {{ old('relation', $calendar->relation) === 'Uncle' ? 'selected' : '' }}>Uncle</option>
                                <option value="Auntie" {{ old('relation', $calendar->relation) === 'Auntie' ? 'selected' : '' }}>Auntie</option>
                                <option value="Son" {{ old('relation', $calendar->relation) === 'Son' ? 'selected' : '' }}>Son</option>
                                <option value="Daughter" {{ old('relation', $calendar->relation) === 'Daughter' ? 'selected' : '' }}>Daughter</option>
                                <option value="Nephew" {{ old('relation', $calendar->relation) === 'Nephew' ? 'selected' : '' }}>Nephew</option>
                                <option value="Niece" {{ old('relation', $calendar->relation) === 'Niece' ? 'selected' : '' }}>Niece</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-700 text-white"><i class="fa-regular fa-calendar-check"></i> Update</button>
                    <a href="{{ route('admin.calendar') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800"><i class="fa-regular fa-calendar-minus"></i> Cancel</a>
                </div>
            </div>
        
    </form>
</body>
</html>

@section('title')
    Update Calendar
@endsection

</x-app-layout>