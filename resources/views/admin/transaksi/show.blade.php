@extends('layouts.app')
@section('title', 'Transaksi')
@section('style')
<link rel="stylesheet" href="{{ asset('css/layouts/sidebar.css') }}">
@endsection
@section('content')

    @include('layouts.sidebar')

    <!-- Main Content -->
    <div id="main-content" class="min-h-screen">
        <!-- Top Navigation -->
        <div class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
            <button onclick="toggleSidebar()" class="text-blue-600 hover:text-blue-900 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h2 class="font-poppins text-xl font-semibold">Transaksi</h2>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D47A1&color=fff" 
                     alt="Admin" class="w-8 h-8 rounded-full">
            </div>
        </div>

    <!-- Transaction Content -->
    <div class="min-h-screen p-6">
        <h2 class="font-poppins text-xl font-semibold mb-4">Detail Transaksi - {{ $transactionId }}</h2>

        <!-- Informasi Transaksi -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="font-poppins text-lg font-semibold mb-4">Informasi Transaksi</h3>

            <div class="inline-grid grid-cols-2 gap-8 text-left">
                <div class="px-4">
                    <p class="text-sm text-gray-600">ID Transaksi</p>
                    <p class="font-medium">{{ $transactionId }}</p>
                </div>
                <div class="px-4">
                    <p class="text-sm text-gray-600">Tanggal</p>
                    <p class="font-medium">{{ $barangKeluar->first()->date }}</p>
                </div>
                <div class="px-4">
                    <p class="text-sm text-gray-600">Customer</p>
                    <p class="font-medium">
                        @if($barangKeluar->first()->membership_type == 'member')
                            {{ $barangKeluar->first()->customer->full_name }}
                        @else
                            Regular Customer
                        @endif
                    </p>
                </div>
                <div class="px-4">
                    <p class="text-sm text-gray-600">Status</p>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Completed
                    </span>
                </div>
            </div>
        </div>

        <!-- List Produk yang Dibeli -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h3 class="font-poppins text-lg font-semibold mb-4">Produk yang Dibeli</h3>

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($barangKeluar as $outgoing)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="text-sm text-gray-900">{{ $outgoing->product->name }}</div>
                            <div class="text-sm text-gray-500">{{ $outgoing->product->description ?? 'No Description' }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $outgoing->quantity }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">Rp {{ number_format($outgoing->selling_price, 2) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">Rp {{ number_format($outgoing->total_price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Transaksi -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="font-poppins text-lg font-semibold mb-4">Ringkasan Transaksi</h3>

            <div class="flex justify-between mb-4">
                <span class="text-gray-600">Subtotal</span>
                <span class="font-medium">Rp {{ number_format($totalPrice, 2) }}</span>
            </div>

            <!-- Pajak jika ada -->
            {{-- <div class="flex justify-between mb-4">
                <span class="text-gray-600">Pajak (11%)</span>
                <span class="font-medium">Rp {{ number_format($totalPrice * 0.11, 2) }}</span>
            </div> --}}

            <!-- Total -->
            <div class="flex justify-between text-lg font-semibold">
                <span>Total</span>
                <span>Rp {{ number_format($totalPrice, 2) }}</span>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="flex justify-end mt-4">
            <a href="{{ route('admin.transaksi') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                Kembali ke Daftar Transaksi
            </a>
        </div>
    </div>

@endsection
