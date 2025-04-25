@extends('layouts.app')
@section('title', 'Barang Keluar')
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
            <h2 class="font-poppins text-xl font-semibold">Barang Keluar</h2>
            <div class="flex items-center">
                <span class="text-gray-600 mr-4">{{ Auth::user()->name }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D47A1&color=fff" 
                     alt="Admin" class="w-8 h-8 rounded-full">
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Outgoing Products Content -->
        <div class="p-6">
            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="font-poppins text-lg font-semibold mb-4">Record Outgoing Product</h3>
                <form id="outgoingForm" action="{{ route('admin.barang-keluar.store') }}" method="POST">
                    @csrf
                    <!-- Transaction Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Customer Type</label>
                            <select name="customer_type" id="customerType" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Customer Type</option>
                                <option value="member">Member</option>
                                <option value="regular">Regular Customer</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Transaction ID</label>
                            <input type="text" name="transaction_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('transaction_id', 'TDS-' . strtoupper(uniqid())) }}" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                            <input type="date" name="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                        </div>
                    </div>

                    <!-- Member Dropdown (Hidden by Default) -->
                    <div id="memberDropdown" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Member</label>
                        <select name="customer_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Member</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->full_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Products Section -->
                    <div class="border rounded-lg p-4 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="font-medium text-gray-700">Products</h4>
                            <button type="button" onclick="addProductRow()" class="bg-blue-100 text-blue-600 px-3 py-1 rounded-lg hover:bg-blue-200">
                                <i class="fas fa-plus mr-1"></i> Add Product
                            </button>
                        </div>

                        <div id="productsContainer">
                            <!-- Product Row Template -->
                            <div class="product-row grid grid-cols-12 gap-4 mb-4">
                                <div class="col-span-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Product</label>
                                    <select name="products[0][product_id]" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="updateProductPrice(this)">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-selling-price="{{ $product->selling_price }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                    <input type="number" name="products[0][quantity]" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Qty" oninput="updateTotals()">
                                </div>
                                <div class="col-span-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                                    <input type="number" name="products[0][price]" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Price" readonly>
                                </div>
                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Total</label>
                                    <input type="text" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2" readonly>
                                </div>
                                <div class="col-span-1 flex items-end">
                                    <button type="button" onclick="removeProductRow(this)" class="text-red-500 hover:text-red-700 px-2 py-2">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Totals -->
                        <div class="border-t pt-4 mt-4">
                            <div class="flex justify-end space-x-4 items-center">
                                <span class="text-gray-700">Subtotal:</span>
                                <span class="font-medium" id="subtotal">Rp 0</span>
                            </div>
                            {{-- <div class="flex justify-end space-x-4 items-center mt-2">
                                <span class="text-gray-700">Tax (11%):</span>
                                <span class="font-medium" id="tax">Rp 0</span>
                            </div> --}}
                            <div class="flex justify-end space-x-4 items-center mt-2">
                                <span class="text-gray-700 font-semibold">Total:</span>
                                <span class="font-semibold text-lg" id="total">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            Record Transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle Member Dropdown
        document.getElementById('customerType').addEventListener('change', function() {
            var customerType = this.value;
            var memberDropdown = document.getElementById('memberDropdown');

            if (customerType === 'member') {
                memberDropdown.style.display = 'block';
            } else {
                memberDropdown.style.display = 'none';
            }
        });

        // Update Product Price when Product is Selected
        function updateProductPrice(selectElement) {
            var priceInput = selectElement.closest('.product-row').querySelector('input[name$="[price]"]');
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var price = selectedOption.getAttribute('data-selling-price');
            priceInput.value = price;
            updateTotals();
        }

        // Add Product Row
        function addProductRow() {
            const container = document.getElementById('productsContainer');
            const template = container.children[0];
            const newRow = template.cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => input.value = '');
            newRow.querySelector('select').selectedIndex = 0;

            const rowCount = container.children.length;
            newRow.querySelector('select').setAttribute('name', 'products[' + rowCount + '][product_id]');
            newRow.querySelector('input[name="products[0][quantity]"]').setAttribute('name', 'products[' + rowCount + '][quantity]');
            newRow.querySelector('input[name="products[0][price]"]').setAttribute('name', 'products[' + rowCount + '][price]');
            
            container.appendChild(newRow);
            updateTotals();
        }

        // Remove Product Row
        function removeProductRow(button) {
            const container = document.getElementById('productsContainer');
            if (container.children.length > 1) {
                button.closest('.product-row').remove();
                updateTotals();
            }
        }

        // Update Totals Calculation
        function updateTotals() {
            const rows = document.querySelectorAll('.product-row');
            let subtotal = 0;

            rows.forEach((row, index) => {
                const quantity = parseFloat(row.querySelector('input[name="products[' + index + '][quantity]"]').value) || 0;
                const price = parseFloat(row.querySelector('input[name="products[' + index + '][price]"]').value) || 0;
                const total = quantity * price;

                row.querySelector('input[type="text"]').value = 'Rp ' + total.toLocaleString();
                subtotal += total;
            });

            const tax = subtotal;
            const total = subtotal;

            document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString();
            // document.getElementById('tax').textContent = 'Rp ' + tax.toLocaleString();
            document.getElementById('total').textContent = 'Rp ' + total.toLocaleString();
        }

        // Add event listeners to quantity and price inputs
        document.getElementById('productsContainer').addEventListener('input', function(e) {
            if (e.target.type === 'number') {
                updateTotals();
            }
        });

        // Initialize totals
        updateTotals();
    </script>

@endsection