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
            <!-- Error Icon -->
            <div class="mb-8">
                <div class="mx-auto w-20 h-20 bg-red-100 rounded-full flex items-center justify-center animate-exclamation">
                    <i class="fas fa-exclamation-triangle text-4xl text-red-500"></i>
                </div>
            </div>

            <!-- Error Message -->
            <h2 class="text-3xl font-poppins font-bold text-gray-900 mb-4">Order Failed</h2>
            <p class="text-gray-600 mb-8">We apologize, but there was an issue processing your order.</p>

            <!-- Error Details -->
            <div class="bg-red-50 rounded-lg p-6 mb-8">
                <h3 class="font-semibold text-lg mb-4">Error Details</h3>
                <div class="space-y-3 text-left">
                    <div class="flex items-start">
                        <i class="fas fa-times-circle text-red-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-red-700">Payment Transaction Failed</p>
                            <p class="text-gray-600 text-sm">The payment could not be processed. Please check your payment method and try again.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                        <div>
                            <p class="font-medium text-blue-700">What You Can Do</p>
                            <ul class="text-gray-600 text-sm list-disc list-inside">
                                <li>Verify your payment information</li>
                                <li>Check your account balance</li>
                                <li>Try a different payment method</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support Information -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <div class="flex items-center justify-center mb-4">
                    <i class="fas fa-headset text-gray-600 text-2xl mr-3"></i>
                    <h3 class="font-semibold text-lg">Need Help?</h3>
                </div>
                <p class="text-gray-600 mb-2">Contact our customer support</p>
                <p class="font-medium">support@tokokelontong.com</p>
                <p class="font-medium">+62 123-456-7890</p>
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