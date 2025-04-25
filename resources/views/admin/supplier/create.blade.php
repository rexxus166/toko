@extends('layouts.app')
@section('title', 'Tambah Supplier')
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
            <h2 class="font-poppins text-xl font-semibold">Tambah Supplier</h2>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D47A1&color=fff" 
                     alt="Admin" class="w-8 h-8 rounded-full">
            </div>
        </div>

        <!-- Create Supplier Form -->
        <div class="p-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('admin.supplier.store') }}" method="POST">
                    @csrf

                    <!-- Supplier Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Supplier Name</label>
                        <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter supplier name" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <a href="{{ route('admin.supplier') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection