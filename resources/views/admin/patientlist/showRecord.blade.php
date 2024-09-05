<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body class="min-h-screen bg-gray-200" style="margin: 0; padding: 0;">

    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold" style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold">
        <h4>Patient List <i class="fa-solid fa-arrow-right-long"></i> {{ $patientlist->name }}</h4>
    </div>

    <div class="grid grid-flow-col grid-rows-2 grid-cols-3 gap-4 p-5 h-screen">
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
                <thead class="text-left">
                    <tr>
                        <td>Gender:</td>
                        <th>{{ $patientlist->gender }}</th>
                    </tr>
                    <tr>    
                        <td>Age:</td>
                        <th>{{ $patientlist->age }}</th>
                    </tr>
                    <tr>
                        <td>Phone No:</td>
                        <th>{{ $patientlist->phone }}</th>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <th>{{ $patientlist->address }}</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="col-start-2 col-span-2 bg-white shadow-md p-5 rounded-xl">
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
            <div class="relative overflow-x-auto">
                <div class="flex justify-between mb-4">
                    <h1 class="text-xl font-bold">LIST OF RECORDS</h1>
                    <a href="{{ route('admin.record.create', $patientlist->id) }}" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-700 text-white"><i class="fa-solid fa-file-circle-plus"></i></a>
                </div>
            
                <table class="min-w-full bg-white text-left rtl:text-right">
                    <thead class="text-gray-800 border-b dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr class="bg-white border-t dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                                <td class="py-4">{{ $record->file }}</td>
                                <td class="py-4">
                                    <a href="{{ route('downloadRecord', $record->id) }}" class="px-2 text-blue-800"><i class="fa-solid fa-download text-lg"></i></a>
                                    <a href="{{ route('updateRecord', [$patientlist->id, $record->id]) }}" class="px-2 text-gray-800"><i class="fa-solid fa-pen text-lg"></i></a>
                                    <form method="post" action="{{ route('deleteRecord', [$patientlist->id, $record->id]) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 text-red-800" onclick="return confirm('Are you sure you want to delete this patient?')"><i class="fa-regular fa-trash-can text-lg"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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