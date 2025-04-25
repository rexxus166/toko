@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('style')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection

@section('content')
    @include('layouts.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-poppins font-semibold mb-6">Shopping Cart</h2>
                
                <!-- Cart Items -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-4">Product</th>
                                <th class="text-left py-4">Price</th>
                                <th class="text-left py-4">Quantity</th>
                                <th class="text-left py-4">Subtotal</th>
                                <th class="text-left py-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($cart as $item)
                            <tr class="border-b">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="{{ asset('imgProduk/' . basename($item->product->image)) }}" alt="Product Image" class="w-20 h-20 object-contain rounded">
                                        <div class="ml-4">
                                            <h3 class="font-medium">{{ $item->product->name }}</h3>
                                            <p class="text-gray-500">{{ $item->product->brand }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">{{ 'Rp ' . number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-4">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity" min="1" value="{{ $item->quantity }}" class="w-20 px-2 py-1 border rounded-lg" onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td class="py-4 subtotal">{{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}</td>
                                <td class="py-4">
                                    <a href="{{ route('cart.remove', $item->id) }}" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cart Summary -->
                <div class="mt-8 border-t pt-6">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg font-medium">Total</span>
                        <span class="text-2xl font-semibold text-blue-600" id="cartTotal">{{ 'Rp ' . number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <a href="{{ route('user.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Continue Shopping
                        </a>

                        <!-- Tombol Checkout dengan kondisi disable -->
                        <a href="{{ route('cart.checkout') }}" 
                            class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 
                            @if ($cart->isEmpty()) pointer-events-none opacity-50 @endif">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection