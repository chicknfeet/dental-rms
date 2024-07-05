<x-app-layout>

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/showrecord.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <h4>Patient List <i class="fa-solid fa-arrow-right-long" style="font-size: 20px;"></i> {{ $patientlist->name }}</h4>
    </div>

    <div class="container">    
        <table class="row" style="background-color:#fff; height:400px; width:40%; border-radius:30px">
            <thead>
                <tr>
                    <th>{{ $patientlist->name }}</th>
                </tr>
                <tr>
                    <th>Gender: {{ $patientlist->gender }}</th>
                    <th>Age: {{ $patientlist->age }}</th>
                </tr>
                <tr>
                    <th>Phone No: {{ $patientlist->phone }}</th>
                    <th>Address: {{ $patientlist->address }}</th>
                </tr>
            </thead>
        </table>


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

        <a href="{{ route('admin.record.create') }}" class="btn btn-primary">Add Record</a>
        <table class="row" style="background-color:#fff; height:400px; width:40%; border-radius:30px">
            <thead>
                <tr>
                    <th>List of Record</th>
                </tr>
            </thead>
            <tbody>
            @if(is_iterable($records) && count($records) > 0)
                @forelse ($records as $record)
                    <tr>
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
                @empty
                    <tr>
                        <td colspan="3">No Record registered yet.</td>
                    </tr>
                @endforelse
            @endif
            </tbody>
        </table>

        <a href="{{ route('admin.patientlist') }}" class="btn btn-secondary mt-3">Back</a>
    </div>
</body>
</html>
@endsection

@section('title')
    Record
@endsection

</x-app-layout>