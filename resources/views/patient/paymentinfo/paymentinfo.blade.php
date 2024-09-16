<x-app-layout>
@section('title', 'My Payment Info')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}" />
</head>
<body class="min-h-screen bg-gray-200" style="margin: 0; padding: 0;">
    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold">
        <h4><i class="fa-solid fa-money-bills"></i> My Payment Info</h4>
    </div>
    
    <div class="actions px-6 py-4 flex justify-end items-center">
        <form action="{{ route('patient.paymentinfo.search') }}" method="GET">
            <div class="relative w-full">
                <input type="text" name="query" placeholder="Search" class="w-full h-10 px-3 rounded-full focus:ring-2 border border-gray-300 focus:outline-none focus:border-blue-500" />
                <button type="submit" class="absolute top-0 end-0 p-2.5 pr-3 text-sm font-medium h-full text-white bg-blue-700 rounded-e-full border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
    @endif
            
    <div class="relative overflow-x-auto">
        <table class="min-w-full bg-white text-left rtl:text-right">
            <thead class="text-gray-800">
                <tr class="border-b-2">
                    <th scope="col" class="px-6 py-4">Description</th>
                    <th scope="col" class="px-6 py-4">Amount</th>
                    <th scope="col" class="px-6 py-4">Balance</th>
                    <th scope="col" class="px-6 py-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentinfo as $payment)
                    <tr class="bg-white border-b hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $payment->description }}</td>
                        <td class="px-6 py-4"><i class="fa-solid fa-peso-sign"></i>{{ $payment->amount }}</td>
                        <td class="px-6 py-4"><i class="fa-solid fa-peso-sign"></i>{{ $payment->balance }}</td>
                        <td class="px-6 py-4">{{ $payment->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            
        {{ $paymentinfo->links() }}
    </div>
</body>
</html>
</x-app-layout>