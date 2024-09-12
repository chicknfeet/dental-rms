<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body class="min-h-screen bg-gray-200" style="margin: 0; padding: 0;">

    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold mb-10">
        <h4><i class="fa-solid fa-user-plus"></i> Add Patient</h4>
    </div>

    <form method="post" action="{{ route('admin.patient.store') }}" class="w-1/2 mx-auto bg-white rounded-lg shadow-md p-10">
        @csrf
        <div class="mb-4">
            <label for="name" class="font-semibold">Patient Name</label>
            <input type="text" id="name" name="name" class="w-full rounded-lg focus:ring-2 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="gender" class="font-semibold">Gender</label>
            <select id="gender" name="gender" class="rounded-lg focus:ring-2 shadow-sm" required>
                <option value="" disabled selected>Select your Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
                
            <label for="age" class="ml-2 font-semibold">Age</label>
            <input type="number" id="age" name="age" class="rounded-lg focus:ring-2 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="email" class="font-semibold">Email</label>
            <input type="email" id="email" name="email" class="w-full rounded-lg focus:ring-2 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="font-semibold">Phone No</label>
            <input type="tel" id="phone" name="phone" class="w-full rounded-lg focus:ring-2 shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="address" class="font-semibold">Address</label>
            <input type="text" id="address" name="address" class="w-full rounded-lg focus:ring-2 shadow-sm" required>
        </div>
        
        @csrf

        <div class="text-right">
            <button type="submit" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-700 text-white"><i class="fa-solid fa-user-plus"></i> Add</button>
            <a href="{{ route('admin.patientlist') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-800"><i class="fa-regular fa-rectangle-xmark"></i> Cancel</a>
        </div>
    </form>
</body>
</html>

@section('title')
    New Patient
@endsection

</x-app-layout>