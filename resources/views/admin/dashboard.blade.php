<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-lg">Welcome, {{ Auth::user()->name }}!</p>
                    <p class="text-sm text-gray-500">You are logged in as an admin.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="h-64 bg-white rounded-lg p-5 m-10 shadow-sm">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl pb-5">Inventory</h1>
            <a href="#" class="px-4 py-2 rounded bg-blue-500 hover:bg-blue-700 text-white">Add</a>
        </div>
        <table class="min-width-screen">
            <thead>
                <tr>
                    <th class="font-semibold">Name</th>
                    <th class="font-semibold px-2">Quantity</th>
                </tr>
            </thead>
            <tbody>
                <td>
                    <td></td>
                    <td></td>
                    <td></td>
                </td>
            </tbody>
        </table>
    </div>

@section('title')
    Dashboard
@endsection

</x-app-layout>
