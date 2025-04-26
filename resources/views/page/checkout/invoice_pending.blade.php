@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('style')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content')
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <!-- Pending Icon -->
            <div class="mb-8">
                <div class="mx-auto w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center animate-pending">
                    <i class="fas fa-hourglass-half text-4xl text-yellow-500"></i>
                </div>
            </div>

            <!-- Pending Message -->
            <h2 class="text-3xl font-poppins font-bold text-gray-900 mb-4">Order Pending</h2>
            <p class="text-gray-600 mb-8">
                Pesanan Anda saat ini sedang menunggu pembayaran. <br>Harap segera lakukan pembayaran sebelum 
                <strong>{{ \Carbon\Carbon::parse($transaction->expiry_time)->format('F j, Y H:i') }}</strong>.
            </p>

            <!-- Order Details -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="font-semibold text-lg mb-4">Order Details</h3>
                <div class="space-y-3 text-left">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Number:</span>
                        <span class="font-medium">#{{ $transaction->transaction_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order Date:</span>
                        <span class="font-medium">{{ $transaction->created_at->format('F j, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Payment Method:</span>
                        <span class="font-medium">{{ $paymentMethodName }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Amount:</span>
                        <span class="font-medium">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status Pembayaran:</span>
                        <span class="font-medium">{{ $transaction->status == 'success' ? 'Lunas' : $transaction->status }}</span>
                    </div>
                </div>
            </div>

            <!-- Estimated Time -->
            <div class="bg-yellow-100 rounded-lg p-6 mb-8">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-clock text-yellow-600 text-2xl mr-3"></i>
                    <h3 class="font-semibold text-lg">Estimated Confirmation Time</h3>
                </div>
                <p class="text-gray-600">Your payment confirmation will be processed within</p>
                <p class="font-semibold text-yellow-600 text-lg">1-2 Business Days</p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <a href="{{ route('user.dashboard') }}" class="block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
@endsection