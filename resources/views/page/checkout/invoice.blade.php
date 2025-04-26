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
            <!-- Success Icon -->
            <div class="mb-8">
                <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center animate-checkmark">
                    <i class="fas fa-check text-4xl text-green-500"></i>
                </div>
            </div>

            <!-- Success Message -->
            <h2 class="text-3xl font-poppins font-bold text-gray-900 mb-4">Order Successful!</h2>
            <p class="text-gray-600 mb-8">Thank you for your purchase. Your order has been successfully placed.</p>

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
                        <span class="font-medium">GoPay</span>
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

            <!-- Estimated Delivery -->
            <div class="bg-blue-50 rounded-lg p-6 mb-8">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-truck text-blue-600 text-2xl mr-3"></i>
                    <h3 class="font-semibold text-lg">Estimated Delivery</h3>
                </div>
                <p class="text-gray-600">Your order will be delivered within</p>
                <p class="font-semibold text-blue-600 text-lg">2-3 Business Days</p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <a href="{{ route('user.dashboard') }}" class="block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
                    Kembali ke Dashboard
                </a>
                {{-- <a href="#" class="block w-full bg-gray-100 text-gray-700 py-3 rounded-lg hover:bg-gray-200">
                    Track Order
                </a> --}}
            </div>
        </div>
    </div>
@endsection