@extends('layouts.app')
@section('title', 'Dashboard Admin')
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
            <h2 class="font-poppins text-xl font-semibold">Dashboard Overview</h2>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D47A1&color=fff" 
                     alt="Admin" class="w-8 h-8 rounded-full">
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-users text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Total Members</h3>
                            <p class="text-2xl font-semibold">{{ $totalMembers }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-box text-green-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Total Products</h3>
                            <p class="text-2xl font-semibold">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-full">
                            <i class="fas fa-shopping-cart text-yellow-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Total Sales</h3>
                            <p class="text-2xl font-semibold">Rp 15.4M</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 rounded-full">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-gray-500 text-sm">Low Stock Items</h3>
                            <p class="text-2xl font-semibold">12</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-poppins text-lg font-semibold mb-4">Recent Activities</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <p class="ml-3 text-gray-600">New member registration: John Doe</p>
                        <span class="ml-auto text-sm text-gray-500">2 minutes ago</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <p class="ml-3 text-gray-600">Product stock updated: Rice (+50kg)</p>
                        <span class="ml-auto text-sm text-gray-500">15 minutes ago</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <p class="ml-3 text-gray-600">New sale: Cooking Oil (5L)</p>
                        <span class="ml-auto text-sm text-gray-500">1 hour ago</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <p class="ml-3 text-gray-600">Low stock alert: Sugar</p>
                        <span class="ml-auto text-sm text-gray-500">2 hours ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection