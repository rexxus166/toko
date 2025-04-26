@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('style')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection 

@section('content')
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-poppins font-semibold mb-6">Riwayat Transaksi</h2>

                <!-- Filter Options -->
                <div class="flex flex-wrap gap-4 mb-6">
                    <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>All Orders</option>
                        <option>Last 30 Days</option>
                        <option>Last 6 Months</option>
                        <option>Last Year</option>
                    </select>
                    <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>All Status</option>
                        <option>Completed</option>
                        <option>Processing</option>
                        <option>Cancelled</option>
                    </select>
                </div>

                <!-- Orders List -->
                <div class="space-y-6">
                    @foreach ($transactions as $transaction)
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-semibold text-lg">#{{ $transaction->transaction_id }}</h3>
                                    <p class="text-gray-600">{{ $transaction->created_at->format('F j, Y') }}</p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm
                                    @if($transaction->status == 'success')
                                        bg-green-100 text-green-800
                                    @elseif($transaction->status == 'pending')
                                        bg-yellow-100 text-yellow-800
                                    @elseif($transaction->status == 'failed')
                                        bg-red-100 text-red-800
                                    @else
                                        bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $transaction->status == 'success' ? 'Sukses' : ($transaction->status == 'pending' ? 'Belum di Bayar' : ($transaction->status == 'failed' ? 'Gagal' : $transaction->status)) }}
                                </span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-gray-600">Items:</p>
                                    <ul class="list-disc list-inside">
                                        @foreach ($transaction->items as $item)
                                            <li>{{ $item->product->name }} ({{ $item->quantity }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <p class="text-gray-600">Payment Method:</p>
                                    <p>Gopay</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t">
                                <span class="font-semibold">Total: Rp {{ number_format($transaction->total) }}</span>
                                <div class="space-x-2">
                                    <a href="{{ route('invoice.show', ['order_id' => $transaction->transaction_id]) }}" class="text-white">
                                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            View Details
                                        </button>
                                    </a>                              
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <i class="fas fa-chevron-left"></i>
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-50">
                            1
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            2
                        </a>
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            3
                        </a>
                        <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection