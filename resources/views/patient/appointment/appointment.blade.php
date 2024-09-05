<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>
    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold ">
        <h4><i class="fa-regular fa-calendar-check"></i> Appointment</h4>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
            
    @error('date')
        <div style="color:red">{{ $message }}</div>
    @enderror
    
    <div class="p-6">
        <form method="post" action="{{ route('patient.calendar.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white rounded-lg shadow-md p-10">
            @csrf
            
            <div class="grid gap-4">
                <div class="flex flex-col space-y-1.5 pb-5">
                    <h3 class="whitespace-nowrap tracking-tight text-3xl font-bold">Patient Appointment</h3>
                    <p class="text-sm text-muted-foreground">Fill out the form to schedule your appointment.</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2">
                        <label for="date" class="font-semibold">Appointment Date</label>
                        <input type="date" class="rounded-lg focus:ring-2 shadow-sm" id="date" name="date" required>
                    </div>

                    <div class="grid gap-2">
                        <label for="time" class="font-semibold time">Appointment Time</label>
                        <input type="time" class="rounded-lg focus:ring-2 shadow-sm" id="time" name="time" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2">
                        <label for="firstname" class="font-semibold">First Name</label>
                        <input type="text" class="rounded-lg focus:ring-2 shadow-sm" id="firstname" name="firstname" required>
                    </div>

                    <div class="grid gap-2">
                        <label for="lastname" class="font-semibold">Last Name</label>
                        <input type="text" class="rounded-lg focus:ring-2 shadow-sm" id="lastname" name="lastname" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2">
                        <label for="dob" class="font-semibold">Date of Birth:</label>
                        <input type="date" class="rounded-lg focus:ring-2 shadow-sm" id="dob" name="dob" required>
                    </div>
                    
                    <div class="grid gap-2">
                        <label for="gender" class="font-semibold">Gender</label>
                        <select id="gender" name="gender" class="rounded-lg focus:ring-2 shadow-sm" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-2">
                    <label for="address" class="font-semibold">Address</label>
                    <textarea type="text" class="rounded-lg focus:ring-2 shadow-sm" id="address" name="address" placeholder="Type here..." required>
                    </textarea>
                </div>
                    
                <div class="btn-container">
                    <button type="submit" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-700 text-white"><i class="fa-regular fa-calendar-check"></i> Appoint</button>  
                </div>
            </div>
            
            <div class="grid gap-4">

                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2">
                        <label for="phone" class="font-semibold">Phone No.</label>
                        <input type="tel" class="rounded-lg focus:ring-2 shadow-sm" id="phone" name="phone" required>
                    </div>
                    
                    <div class="grid gap-2">
                        <label for="email" class="font-semibold">Email</label>
                        <input type="email" class="rounded-lg focus:ring-2 shadow-sm" id="email" name="email" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2">
                        <label for="name" class="font-semibold">Name (Optional)</label>
                        <input type="text" class="rounded-lg focus:ring-2 shadow-sm" id="name" name="name" required>
                    </div>

                    <div class="grid gap-2">
                    <label for="relation" class="font-semibold">Relation</label>
                        <select id="relation" name="relation" class="rounded-lg focus:ring-2 shadow-sm" required>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                            <option value="Son">Son</option>
                            <option value="Daughter">Daughter</option>
                            <option value="Nephew">Nephew</option>
                            <option value="Niece">Niece</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid gap-2">
                    <label for="medical-history" class="font-semibold">Medical History (Optional)</label>
                    <textarea type="text" class="rounded-lg focus:ring-2 shadow-sm" id="medical-history" name="medical-history" placeholder="Type here..." required>
                    </textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="grid gap-2">
                        <label for="name" class="font-semibold">Name</label>
                        <input type="text" class="rounded-lg focus:ring-2 shadow-sm" id="name" name="name" required>
                    </div>

                    <div class="grid gap-2">
                        <label for="relation" class="font-semibold">Relation</label>
                        <input type="text" class="rounded-lg focus:ring-2 shadow-sm" id="relation" name="relation" required>
                    </div>
                </div>
                
                <div class="grid gap-2">
                    <label for="phone" class="font-semibold">Phone No.</label>
                    <input type="tel" class="rounded-lg focus:ring-2 shadow-sm" id="phone" name="phone" required>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

@section('title')
    Appointment
@endsection

</x-app-layout>