@extends('layouts.app')
@section('title', 'Barang Masuk')
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
            <h2 class="font-poppins text-xl font-semibold">Barang Masuk</h2>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D47A1&color=fff" 
                     alt="Admin" class="w-8 h-8 rounded-full">
            </div>
        </div>

        <!-- Incoming Products Content -->
        <div class="p-6">
                <!-- Form Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="font-poppins text-lg font-semibold mb-4">Add Incoming Product</h3>
                    <form action="{{ route('admin.barang-masuk.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Product</label>
                            <select name="product_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Product</option>
                                @foreach ($produk as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Supplier</label>
                            <select name="supplier_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Supplier</option>
                                @foreach ($supplier as $sup)
                                    <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" name="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Recent Incoming Products -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="font-poppins text-lg font-semibold">Recent Incoming Products</h3>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Supplier
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($barangMasuk as $bm)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $bm->date }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ optional($bm->product)->name ?? 'No Product' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ optional($bm->supplier)->name ?? 'No Supplier' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $bm->quantity }} {{ $bm->product->unit }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($bm->purchase_price, 2) }}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection