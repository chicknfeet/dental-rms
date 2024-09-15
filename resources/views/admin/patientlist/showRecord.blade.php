<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>

    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold" style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold">
        <h4><i class="fa-solid fa-users"></i> Patient List / {{ $patientlist->firstname }} {{ $patientlist->lastname }}</h4>
    </div>

    <div class="grid grid-flow-col grid-cols-3 grid-rows-2 gap-4 p-5 max-h-screen">
        
        <!-- Patient details -->
        <div class="col-start-1 bg-white shadow-md p-5 rounded-xl h-[250px]">
            <h1 class="text-xl font-bold border-b-2">Patient Details</h1>
            <div class="max-h-96 overflow-y-auto oveflow-x-auto">
                <table class="min-w-full bg-white text-left rtl:text-right mb-4">
                    <thead class="whitespace-nowrap overflow-hidden">
                        <tr>
                            <td>Full Name:</td>
                            <th>{{ $patientlist->firstname }} {{ $patientlist->lastname }}</th>
                        </tr>
                        <tr>
                            <td>Birthday:</td>
                            <th>{{ $patientlist->birthday }}</th>
                        </tr>
                        <tr>    
                            <td>Age:</td>
                            <th>{{ $patientlist->age }}</th>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <th>{{ $patientlist->gender }}</th>
                        </tr>
                        <tr>
                            <td>Phone No:</td>
                            <th>{{ $patientlist->phone }}</th>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <th>{{ $patientlist->address }}</th>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <th>{{ $patientlist->email }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        
        <!-- Patient records -->
        <div class="col-start-3 row-span-2 bg-white shadow-md p-5 rounded-xl">
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

            <div class="flex justify-between mb-4">
                <h1 class="text-2xl font-bold"><i class="fa-regular fa-folder-open"></i> List of Records</h1>
                <a href="{{ route('admin.record.create', $patientlist->id) }}" class="px-4 py-1 rounded bg-blue-500 hover:bg-blue-700 text-white"><i class="fa-solid fa-file-circle-plus"></i></a>
            </div>

            <!-- <thead class="text-gray-800 border-b">
                <tr>
                    <th scope="col">File</th>
                </tr>
            </thead> -->
            <h1 class="text-xl font-bold">Files</h1>
            <div class="max-h-96 overflow-y-auto overflow-x-auto border-t-2 border-b">
                
                <table class="min-w-full bg-white text-left rtl:text-right">
                    <tbody>
                        @foreach ($records as $record)
                            <tr class="relative group bg-white border-b hover:bg-gray-100">
                                <td class="py-4 whitespace-nowrap overflow-hidden cursor-pointer">{{ $record->file }}</td>
                                <td class="py-4 whitespace-nowrap overflow-hidden">
                                    <div class="bg-white px-4 py-2 rounded-lg shadow-md absolute left-1/2 top-1/2 transform -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex space-x-2">
                                        <a href="{{ route('admin.downloadRecord', $record->id) }}" class="px-2 text-blue-800"><i class="fa-solid fa-download text-lg"></i></a>
                                        <a href="{{ route('admin.updateRecord', [$patientlist->id, $record->id]) }}" class="px-2 text-gray-800"><i class="fa-solid fa-pen text-lg"></i></a>
                                        <form method="post" action="{{ route('admin.deleteRecord', [$patientlist->id, $record->id]) }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 text-red-800" onclick="return confirm('Are you sure you want to delete this patient?')"><i class="fa-regular fa-trash-can text-lg"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Patient upcoming appointment -->
        <div class="row-start-2 col-span-2 bg-white shadow-md p-5 rounded-xl h-[250px]">
            <h1 class="text-xl font-bold border-b-2">Upcoming Appointment</h1>
        </div>

        <!-- Patient notes -->
        <div class="col-start-2 bg-white shadow-md p-5 rounded-xl h-[250px]">
            <div class="flex justify-between">
                <h1 class="text-xl font-bold">Notes</h1>
                <!-- Button to open modal -->
                <button id="openModalBtn" class="px-4 py-1 bg-blue-500 text-white rounded">Add Notes</button>
            </div>

            <!-- Display Notes -->
            <div class="relative">
                <table class="">
                    <tbody>
                        @foreach ($notes as $note)
                            <tr class="">
                                <td class="">{{ $note->note }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Structure -->
            <div id="notesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <h2 class="text-2xl font-semibold mb-4">Add a Note</h2>
                    <form method="post" action="{{ route('admin.note.store') }}">
                        @csrf
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