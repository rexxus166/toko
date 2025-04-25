@extends('layouts.app')
@section('title', 'Kelola Produk')
@section('style')
<link rel="stylesheet" href="{{ asset('css/layouts/sidebar.css') }}">
@endsection
@section('content')

@include('layouts.sidebar')

<div id="main-content" class="min-h-screen">
    <!-- Top Navigation -->
    <div class="bg-white shadow-md py-4 px-6 flex justify-between items-center">
        <button onclick="toggleSidebar()" class="text-blue-600 hover:text-blue-900 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>
        <h2 class="font-poppins text-xl font-semibold">Edit Product</h2>
    </div>

    <!-- Product Edit Form -->
    <div class="p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Menggunakan metode PUT untuk update -->
                
                <!-- Add form fields here -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold mb-4">Product Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                            <input type="text" name="product_name" value="{{ $product->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <input type="text" name="category" value="{{ $product->category }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                            <input type="text" name="brand" value="{{ $product->brand }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                            <input type="text" name="sku" value="{{ $product->sku }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Purchase Price</label>
                            <input type="number" name="purchase_price" value="{{ $product->purchase_price }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Selling Price</label>
                            <input type="number" name="selling_price" value="{{ $product->selling_price }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stock</label>
                            <input type="number" name="initial_stock" value="{{ $product->stock }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unit</label>
                            <input type="text" name="unit" value="{{ $product->unit }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Stock Alert</label>
                            <input type="number" name="min_stock_alert" value="{{ $product->min_stock_alert }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $product->description }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                            <input type="file" name="image" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('admin.produk') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection