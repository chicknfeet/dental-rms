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
                    <h1 class="text-xl font-bold"><i class="fa-regular fa-folder-open"></i> List of Records</h1>
                    <a href="{{ route('admin.record.create', $patientlist->id) }}" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-700 text-white"><i class="fa-solid fa-file-circle-plus"></i></a>
                </div>
            
                <table class="min-w-full bg-white text-left rtl:text-right">
                    <thead class="text-gray-800 border-b">
                        <tr>
                            <th scope="col">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                            <tr class="bg-white border-t hover:bg-gray-100">
                                <td class="py-4">{{ $record->file }}</td>
                                <td class="py-4">
                                    <a href="{{ route('admin.downloadRecord', $record->id) }}" class="px-2 text-blue-800"><i class="fa-solid fa-download text-lg"></i></a>
                                    <a href="{{ route('admin.updateRecord', [$patientlist->id, $record->id]) }}" class="px-2 text-gray-800"><i class="fa-solid fa-pen text-lg"></i></a>
                                    <form method="post" action="{{ route('admin.deleteRecord', [$patientlist->id, $record->id]) }}" style="display: inline;">
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
            <div class="flex justify-between">
                <h1 class="text-xl font-bold">Notes</h1>
                <!-- Button to open modal -->
                <button id="openModalBtn" class="px-4 py-2 bg-blue-500 text-white rounded">Add Notes</button>
            </div>

            <!-- Display Notes -->
            <div class="relative overflow-x-auto">
                <table>
                    <tbody>
                        <!-- foreach here -->
                    </tbody>
                </table>
            </div>

            <!-- Modal Structure -->
            <div id="notesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h2 class="text-2xl font-semibold mb-4">Add a Note</h2>
                    <form id="notesForm">
                        <div class="mb-4">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea id="note" name="note" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Enter note" required></textarea>
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save Notes</button>
                            <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const notesModal = document.getElementById('notesModal');

        openModalBtn.addEventListener('click', () => {
            notesModal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            notesModal.classList.add('hidden');
        });

        // Close modal if clicking outside the modal-content
        window.addEventListener('click', (event) => {
            if (event.target === notesModal) {
                notesModal.classList.add('hidden');
            }
        });
    </script>
</body>
</html>

@section('title')
    Record
@endsection

</x-app-layout>