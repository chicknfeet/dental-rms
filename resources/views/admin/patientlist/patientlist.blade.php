<x-app-layout>

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
</head>
<body class="min-h-screen bg-gray-200" style="margin: 0; padding: 0; font-family: Helvetica;">
    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold">
        <h4><i class="fa-solid fa-users"></i> Patient List</h4>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="actions px-6 py-4 flex justify-between items-center">
        <a href="{{ route('admin.patient.create') }}" class="px-4 py-2 rounded bg-blue-500 text-white"><i class="fa-solid fa-user-plus"></i> New</a>
        
        <form action="{{ route('admin.search') }}" method="GET">
            <input type="text" name="query" placeholder="Search" class="w-full h-10 px-3 rounded-full border border-gray-300 focus:outline-none focus:border-blue-500">
        </form>
    </div>
        
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-lg font-semibold">Name</th>
                    <th class="px-6 py-3 text-left text-lg font-semibold">Gender</th>
                    <th class="px-6 py-3 text-left text-lg font-semibold">Age</th>
                    <th class="px-6 py-3 text-left text-lg font-semibold">Phone No.</th>
                    <th class="px-6 py-3 text-left text-lg font-semibold">Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patientlist as $patient)
                    <tr style="border-top: 7px solid #f1eaead3;">
                        <td  class="px-6 py-4 whitespace-nowrap">{{ $patient->name }}</td>
                        <td  class="px-6 py-4 whitespace-nowrap">{{ $patient->gender }}</td>
                        <td  class="px-6 py-4 whitespace-nowrap">{{ $patient->age }}</td>
                        <td  class="px-6 py-4 whitespace-nowrap">{{ $patient->phone}}</td>
                        <td  class="px-6 py-4 whitespace-nowrap">{{ $patient->address}}</td>
                        <td  class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.showRecord', $patient->id) }}" class="px-4 py-2 rounded hover:bg-gray-200 transition duration-300 text-base"><i class="fa-regular fa-file-lines"></i> Records</a>
                            <a href="{{ route('admin.updatePatient', $patient->id) }}" class="px-4 py-2 rounded hover:bg-gray-200 transition duration-300 text-base"><i class="fa-solid fa-pen"></i> Edit</a>
                            
                            <a href="{{ route('admin.deletePatient', $patient->id) }}" class="px-4 py-2 rounded text-red-800 hover:bg-red-200 transition duration-300 text-base" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this patient?')) { document.getElementById('delete-patient-form').submit(); }"><i class="fa-regular fa-trash-can"></i> Delete</a>
                            <!-- hidden form for csrf -->
                            <form id="delete-patient-form" method="post" action="{{ route('admin.deletePatient', $patient->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    
        
        <!-- pagination here -->
        @if ($patientlist->lastPage() > 1)
            <ul class="pagination mt-8 mb-8 flex items-center justify-center">
                <!-- Previous Page Link -->
                @if ($patientlist->onFirstPage())
                <li class="page-item disabled mx-1" aria-disabled="true">
                    <span class="page-link text-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" aria-hidden="true">&laquo;</span>
                </li>
                @else
                    <li class="page-item">
                        <a class="page-link text-blue-500 hover:text-white hover:bg-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" href" href="{{ $patientlist->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                    </li>
                @endif

                <!-- Pagination Elements -->
                @for ($i = 1; $i <= $patientlist->lastPage(); $i++)
                    @if ($i == $patientlist->currentPage())
                        <li class="page-item active mx-1" aria-current="page"><span class="page-link text-white px-4 py-2 rounded-lg bg-blue-500">{{ $i }}</span></li>
                    @else
                        <li class="page-item mx-1"><a class="page-link text-blue-500 hover:text-white hover:bg-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" href="{{ $patientlist->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                <!-- Next Page Link -->
                @if ($patientlist->hasMorePages())
                    <li class="page-item mx-1">
                        <a class="page-link text-blue-500 hover:text-white hover:bg-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" href="{{ $patientlist->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link text-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" aria-hidden="true">&raquo;</span>
                    </li>
                @endif
            </ul>
        @endif

    </div>
</body>
</html>
@endsection

@section('title')
    Patient List
@endsection

</x-app-layout>