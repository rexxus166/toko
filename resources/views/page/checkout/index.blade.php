@extends('layouts.app')

@section('title', 'Checkout')

@section('style')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection 

@section('content')
    @include('layouts.navbar')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Checkout Steps -->
        <div class="flex items-center justify-center mb-8">
            <div class="flex items-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center">
                    1
                </div>
                <div class="text-blue-600 ml-2">Cart</div>
            </div>
            <div class="h-1 w-16 bg-blue-600 mx-4"></div>
            <div class="flex items-center">
                <div class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center">
                    2
                </div>
                <div class="text-blue-600 ml-2">Payment</div>
            </div>
            <div class="h-1 w-16 bg-gray-300 mx-4"></div>
            <div class="flex items-center">
                <div class="bg-gray-300 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center">
                    3
                </div>
                <div class="text-gray-600 ml-2">Complete</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Payment Methods -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-poppins font-semibold mb-6">Pembayaran bisa dengan :</h2>
                    
                    <!-- E-Wallet Methods -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">E-Wallet</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- ShopeePay -->
                            <div class="payment-method-card border rounded-lg p-4 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="flex items-center flex-1">
                                        <div>
                                            <img src="https://deo.shopeemobile.com/shopee/shopee-shopeepayfe-live-id/shopeepay-website/shopeepay-logo.png" width="35%" alt="">
                                            <p class="text-sm text-gray-500">Instant payment via ShopeePay</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- GOPAY -->
                            <div class="payment-method-card border rounded-lg p-4 cursor-pointer">
                                <div class="flex items-center">
                                    <div class="flex items-center flex-1">
                                        <div>
                                            <img src="https://logos-world.net/wp-content/uploads/2023/03/GoPay-Logo.png" width="25%" alt="">
                                            <p class="text-sm text-gray-500">Instant payment via GoPay</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Transfer -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Bank Transfer</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <p class="flex items-center">
                                <img src="https://buatlogoonline.com/wp-content/uploads/2022/10/Logo-BCA-PNG.png" width="10%" class="mr-5" alt="Bank BCA">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" width="10%" class="mr-5" alt="Bank Mandiri">
                                <img src="https://buatlogoonline.com/wp-content/uploads/2022/10/Logo-Bank-BRI.png" width="10%" class="mr-5" alt="Bank BRI">
                                <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png" width="10%" class="mr-5" alt="Bank BNI">
                            </p>
                        </div>
                    </div>

                    <!-- Outlet -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4">Outlet</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <p class="flex items-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/ALFAMART_LOGO_BARU.png/1200px-ALFAMART_LOGO_BARU.png" width="10%" class="mr-5" alt="Alfamart">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdscPu-Zpl9_aSk3u-jzCC6PNal159ddfWzA&s" width="10%" class="mr-5" alt="Alfamidi">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png" width="10%" class="mr-5" alt="Indomaret">
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-poppins font-semibold mb-6">Order Summary</h2>
                    
                    <!-- Items Summary -->
                    <div class="space-y-4 mb-6">
                        @foreach ($cart as $item)
                            <div class="flex justify-between">
                                <span class="text-gray-600">{{ $item->product->name }} ({{ $item->quantity }}x)</span>
                                <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Calculations -->
                    <div class="border-t pt-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Fee</span>
                            <span>Rp 2.000</span>
                        </div>
                        <div class="flex justify-between font-semibold text-lg border-t pt-2 mt-2">
                            <span>Total</span>
                            <span class="text-blue-600">Rp {{ number_format($total + 2000, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <button id="payButton" class="w-full bg-blue-600 text-white py-3 rounded-lg mt-6 hover:bg-blue-700">
                        Bayar Sekarang
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>

                    <!-- Back to Cart -->
                    <a href="{{ route('cart.index') }}" class="block text-center text-blue-600 mt-4 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script>
        document.getElementById('payButton').addEventListener('click', function() {
            // Mengambil Snap Token dari server
            fetch("{{ route('payment') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        console.log(result);
                        // Redirect atau tampilkan halaman sukses
                    },
                    onPending: function(result) {
                        console.log(result);
                        // Redirect atau tampilkan halaman pending
                    },
                    onError: function(result) {
                        console.log(result);
                        // Redirect atau tampilkan halaman error
                    }
                });
            });
        });
    </script>
@endsection