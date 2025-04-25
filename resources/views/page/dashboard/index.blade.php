@extends('layouts.app')
@section('title', 'Dashboard')
@section('style')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection
@section('content')
    
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Categories and Filters -->
        <div class="flex flex-col md:flex-row gap-6 mb-8">
            <!-- Categories -->
            @include('layouts.filter')

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Sort Options -->
                <div class="bg-white rounded-lg shadow-md p-4 mb-6 flex justify-between items-center">
                    <span class="text-gray-600">Showing {{ $products->count() }} of {{ $products->total() }} products</span>
                </div>

                <!-- Products -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden product-card {{ $product->category }}">
                        <img src="{{ file_exists(public_path('imgProduk/' . basename($product->image))) ? asset('imgProduk/' . basename($product->image)) : '' }}" 
                            alt="Product Image" 
                            class="w-full h-48 object-contain">
                        <div class="p-4">
                        <h3 class="font-medium text-lg mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-blue-600 font-semibold">{{ 'Rp ' . number_format($product->selling_price, 0, ',', '.') }}</span>
                            
                            <!-- Add to Cart Form -->
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product[id]" value="{{ $product->id }}">
                                <input type="hidden" name="product[name]" value="{{ $product->name }}">
                                <input type="hidden" name="product[price]" value="{{ $product->selling_price }}">
                                <input type="hidden" name="product[image]" value="{{ asset('imgProduk/' . basename($product->image)) }}">
                                <input type="hidden" name="quantity" value="1"> <!-- Quantity is set to 1 by default -->
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
@endsection