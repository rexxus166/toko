@extends('layouts.app')
@section('title', 'Add New Product')
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
            <h2 class="font-poppins text-xl font-semibold">Add New Product</h2>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D47A1&color=fff" 
                     alt="Admin" class="w-8 h-8 rounded-full">
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Basic Information -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                                <input type="text" name="product_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter product name" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Select category</option>
                                    <option value="groceries">Groceries</option>
                                    <option value="beverages">Beverages</option>
                                    <option value="snacks">Snacks</option>
                                    <option value="household">Household</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Brand</label>
                                <input type="text" name="brand" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter brand name" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">SKU</label>
                                <input type="text" name="sku" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter SKU" required>
                            </div>
                        </div>
                    </div>
                
                    <!-- Pricing and Stock -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold mb-4">Pricing and Stock</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Purchase Price</label>
                                <input type="number" name="purchase_price" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter purchase price" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Selling Price</label>
                                <input type="number" name="selling_price" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter selling price" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Initial Stock</label>
                                <input type="number" name="initial_stock" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter initial stock" required>
                            </div>
                        </div>
                    </div>
                
                    <!-- Product Details -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-semibold mb-4">Product Details</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter product description"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                                <div id="imagePreview" class="image-preview mb-4">
                                    <div class="text-center text-gray-500">
                                        <i class="fas fa-image text-4xl mb-2"></i>
                                        <p>Click to upload or drag and drop</p>
                                        <p class="text-sm">PNG, JPG up to 5MB</p>
                                    </div>
                                </div>
                                <input type="file" name="image" accept="image/*" onchange="previewImage(event)" class="w-full">
                            </div>
                        </div>
                    </div>
                
                    <!-- Additional Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Additional Information</h3>
                        <select name="unit" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select unit</option>
                            <option value="pcs">Pieces</option>
                            <option value="kg">Kilogram</option>
                            <option value="g">Gram</option>
                            <option value="l">Liter</option>
                        </select>
                        <input type="number" name="min_stock_alert" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4" placeholder="Enter minimum stock level" required>
                    </div>
                
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.produk') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Product</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
@endsection