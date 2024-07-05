<x-app-layout>

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/patientlist.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="header">
        <h4><i class="fa-solid fa-users"></i> Patient List</h4>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="actions">
        <a href="{{ route('admin.patient.create') }}" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> New</a>
        <input href="{{ route('admin.patient.create') }}" class="form-control" type="search" placeholder="Search"></input>
    </div>
        
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Phone No.</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patientlist as $patient)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->phone}}</td>
                    <td>{{ $patient->address}}</td>
                    <td>
                        <a href="{{ route('admin.showRecord', $patient->id) }}" class="btn btn-light" data-toggle="tooltip"><i class="fa-regular fa-file-lines record"></i> Records/Details</a>
                        <a href="{{ route('admin.updatePatient', $patient->id) }}" class="btn btn-light"><i class="fa-solid fa-pen update"></i> Edit</a>
                        <form method="post" action="{{ route('admin.deletePatient', $patient->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color:red;" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this patient?')"><i class="fa-regular fa-trash-can delete"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        
    <!-- pagination here -->
    @if ($patientlist->lastPage() > 1)
        <ul class="pagination">
            <!-- Previous Page Link -->
            @if ($patientlist->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $patientlist->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                </li>
            @endif

            <!-- Pagination Elements -->
            @for ($i = 1; $i <= $patientlist->lastPage(); $i++)
                @if ($i == $patientlist->currentPage())
                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $i }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $patientlist->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            <!-- Next Page Link -->
            @if ($patientlist->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $patientlist->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    @endif
</body>
</html>
@endsection

@section('title')
    Patient List
@endsection

</x-app-layout>