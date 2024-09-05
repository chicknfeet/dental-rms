<x-app-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
</head>
<body>

    <div style="background-color: #4b9cd3; box-shadow: 0 2px 4px rgba(0,0,0,0.4);" class="header py-4 px-6 flex justify-between items-center text-white text-2xl font-semibold mb-10">
        <h4><i class="fa-solid fa-money-bills"></i> Payment Info</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="relative overflow-x-auto">
        <table class="min-w-full bg-white text-left rtl:text-right">
            <thead class="text-gray-800 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-4">Patient</th>
                    <th scope="col" class="px-6 py-4">Description</th>
                    <th scope="col" class="px-6 py-4">Amount</th>
                    <th scope="col" class="px-6 py-4">Balance</th>
                    <th scope="col" class="px-6 py-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentinfo as $payment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">{{ $payment->patient }}</td>
                        <td class="px-6 py-4">{{ $payment->description }}</td>
                        <td class="px-6 py-4"><i class="fa-solid fa-peso-sign"></i>{{ $payment->amount }}</td>
                        <td class="px-6 py-4"><i class="fa-solid fa-peso-sign"></i>{{ $payment->balance }}</td>
                        <td class="px-6 py-4">{{ $payment->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- pagination here -->
        @if ($paymentinfo->lastPage() > 1)
            <ul class="pagination mt-8 mb-8 flex items-center justify-center">
                <!-- Previous Page Link -->
                @if ($paymentinfo->onFirstPage())
                <li class="page-item disabled mx-1" aria-disabled="true">
                    <span class="page-link text-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" aria-hidden="true">&laquo;</span>
                </li>
                @else
                    <li class="page-item">
                        <a class="page-link text-blue-500 hover:text-white hover:bg-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" href" href="{{ $paymentinfo->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                    </li>
                @endif

                <!-- Pagination Elements -->
                @for ($i = 1; $i <= $paymentinfo->lastPage(); $i++)
                    @if ($i == $paymentinfo->currentPage())
                        <li class="page-item active mx-1" aria-current="page"><span class="page-link text-white px-4 py-2 rounded-lg bg-blue-500">{{ $i }}</span></li>
                    @else
                        <li class="page-item mx-1"><a class="page-link text-blue-500 hover:text-white hover:bg-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" href="{{ $paymentinfo->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor

                <!-- Next Page Link -->
                @if ($paymentinfo->hasMorePages())
                    <li class="page-item mx-1">
                        <a class="page-link text-blue-500 hover:text-white hover:bg-blue-500 px-4 py-2 rounded-lg bg-white border border-gray-300" href="{{ $paymentinfo->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
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

@section('title')
    Payment Info
@endsection

</x-app-layout>