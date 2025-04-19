@extends('layouts.user')

@section('usercontent')
<main class="py-8 px-4 pt-24">
    <div class="max-w-4xl mx-auto">
        <!-- Header Checkout -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Checkout</h1>
            <p class="text-gray-500 mt-2">Selesaikan pembayaran untuk melanjutkan</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Progress Steps -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex justify-center">
                    <div class="flex items-center text-sm md:text-base">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">1</div>
                            <span class="text-xs mt-1 font-medium text-indigo-600">Pilih Paket</span>
                        </div>
                        <div class="h-1 w-12 md:w-24 bg-indigo-600"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">2</div>
                            <span class="text-xs mt-1 font-medium text-indigo-600">Pembayaran</span>
                        </div>
                        <div class="h-1 w-12 md:w-24 bg-gray-300"></div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-500 font-bold">3</div>
                            <span class="text-xs mt-1 font-medium text-gray-500">Konfirmasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Content -->
            <div class="p-6 md:p-8 flex flex-col md:flex-row gap-8">
                <!-- Left: Payment Options -->
                <div class="w-full md:w-2/3">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Detail Pembayaran</h2>

                    <form method="POST" action="{{ route('subscription.pay') }}" class="space-y-6">
                        @csrf
                        <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                        <!-- Metode Pembayaran -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-3">Pilih Metode Pembayaran</label>

                            <!-- E-Wallet Options -->
                            <div class="mb-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">E-Wallet</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="gopay" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://antinomi.org/wp-content/uploads/2022/03/logo-gopay-vector.png" alt="GoPay" class="h-8 object-contain">
                                            <span class="text-sm mt-2">GoPay</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>

                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="ovo" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/2560px-Logo_ovo_purple.svg.png" alt="OVO" class="h-8 object-contain">
                                            <span class="text-sm mt-2">OVO</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>

                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="dana" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/1200px-Logo_dana_blue.svg.png" alt="DANA" class="h-8 object-contain">
                                            <span class="text-sm mt-2">DANA</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Bank Transfer Options -->
                            <div class="mb-4">
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Transfer Bank</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="bca" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" alt="BCA" class="h-8 object-contain">
                                            <span class="text-sm mt-2">Bank BCA</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>

                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="mandiri" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" class="h-8 object-contain">
                                            <span class="text-sm mt-2">Bank Mandiri</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>

                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="bni" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/2/27/BankNegaraIndonesia46-logo.svg/1200px-BankNegaraIndonesia46-logo.svg.png" alt="BNI" class="h-8 object-contain">
                                            <span class="text-sm mt-2">Bank BNI</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Credit Card Options -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-2">Kartu Kredit/Debit</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="visa" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" class="h-8 object-contain">
                                            <span class="text-sm mt-2">Visa</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>

                                    <label class="relative flex items-center justify-center bg-white border border-gray-200 rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition-all">
                                        <input type="radio" name="payment_method" value="mastercard" class="absolute opacity-0">
                                        <div class="flex flex-col items-center">
                                            <img src="https://download.logo.wine/logo/Mastercard/Mastercard-Logo.wine.png" alt="Mastercard" class="h-8 object-contain">
                                            <span class="text-sm mt-2">Mastercard</span>
                                        </div>
                                        <span class="absolute top-2 right-2 w-4 h-4 rounded-full border border-gray-300 flex items-center justify-center payment-check invisible">
                                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Bayar -->
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                                Bayar Sekarang
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right: Order Summary -->
                <div class="w-full md:w-1/3 bg-gray-50 rounded-xl p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Pembelian</h2>

                    <!-- Plan Details -->
                    <div class="border-b border-gray-200 pb-4 mb-4">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-600">Paket</span>
                            <span class="font-medium">{{ $plan->name }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-medium">{{ $plan->duration }} Bulan</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Max Download</span>
                            <span class="font-medium">{{ $plan->max_downloads }} item</span>
                        </div>
                    </div>

                    <!-- Plan Features -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Benefit Paket Premium:</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Akses {{ $plan->max_downloads }} download per bulan
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Akses konten premium ekslusif
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Bebas iklan
                            </li>
                            <li class="flex items-center text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Dukungan prioritas
                            </li>
                        </ul>
                    </div>

                    <!-- Price Total -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rp{{ number_format($plan->price) }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-600">PPN (11%)</span>
                            <span class="font-medium">Rp{{ number_format($plan->price * 0.11) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-lg font-bold mt-4">
                            <span>Total</span>
                            <span class="text-indigo-600">Rp{{ number_format($plan->price * 1.11) }}</span>
                        </div>
                    </div>

                    <!-- Secure Payment -->
                    <div class="mt-6 flex items-center justify-center text-sm text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        Pembayaran Aman & Terenkripsi
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paymentOptions = document.querySelectorAll('input[name="payment_method"]');

    paymentOptions.forEach(option => {
        option.addEventListener('change', function() {
            // Reset all checks
            document.querySelectorAll('.payment-check').forEach(check => {
                check.classList.add('invisible');
            });

            // Reset all borders
            document.querySelectorAll('input[name="payment_method"]').forEach(input => {
                input.closest('label').classList.remove('border-indigo-500');
                input.closest('label').classList.add('border-gray-200');
            });

            // Mark selected
            if (this.checked) {
                this.closest('label').classList.remove('border-gray-200');
                this.closest('label').classList.add('border-indigo-500');
                this.closest('label').querySelector('.payment-check').classList.remove('invisible');
            }
        });
    });
});
</script>
@endsection
