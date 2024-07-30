<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
</head>
<body class="min-h-screen bg-gray-200" style="margin: 0; padding: 0; font-family: Helvetica;">

    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold" style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold">
        <h4>Patient List <i class="fa-solid fa-arrow-right-long"></i> {{ $patientlist->name }}</h4>
    </div>

    <div class="grid grid-rows-2 grid-cols-3 gap-4 p-5 h-screen">
        <div class="row-start-1 bg-white shadow-md p-5 rounded-xl">
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>{{ $patientlist->name }}</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="row-start-2 bg-white shadow-md p-5 rounded-xl">
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>Gender: {{ $patientlist->gender }}</th>
                    </tr>
                    <tr>    
                        <th>Age: {{ $patientlist->age }}</th>
                    </tr>
                    <tr>
                        <th>Phone No: {{ $patientlist->phone }}</th>
                    </tr>
                    <tr>
                        <th>Address: {{ $patientlist->address }}</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="col-span-2 bg-white shadow-md p-5 rounded-xl">
            <h1>Updcomming Appointment</h1>
        </div>

        <div class="col-start-2 bg-white shadow-md p-5 rounded-xl">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <table class="table-auto">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>List of Record</th>
                        <th><a href="{{ route('admin.record.create') }}" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-700 text-white"><i class="fa-solid fa-file-circle-plus"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->id }}</td>
                            <td>{{ $record->file }}</td>
                            <td>
                                <a href="{{ route('updateRecord', [$patientlist->id, $record->id]) }}" class="btn btn-warning">Edit patient</a>
                                <form method="post" action="{{ route('deleteRecord', [$patientlist->id, $patient->id]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-start-3 bg-white shadow-md p-5 rounded-xl">
            <h1>Notes</h1>
        </div>
    </div>
</body>
</html>

@section('title')
    Record
@endsection

</x-app-layout>