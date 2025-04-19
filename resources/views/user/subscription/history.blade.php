@extends('layouts.user')

@section('usercontent')
<main class="pt-32 px-10 pb-52">


    <h1 class="text-2xl font-bold mb-4">Riwayat Langganan</h1>

    @if ($payments->isEmpty())
        <p class="text-gray-500">Kamu belum pernah berlangganan.</p>
    @else
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 text-left">Plan</th>
                    <th class="py-2 px-4 text-left">Harga</th>
                    <th class="py-2 px-4 text-left">Durasi</th>
                    <th class="py-2 px-4 text-left">Tanggal Mulai</th>
                    <th class="py-2 px-4 text-left">Tanggal Selesai</th>
                    <th class="py-2 px-4 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $payment->plan->name }}</td>
                        <td class="py-2 px-4">Rp{{ number_format($payment->plan->price) }}</td>
                        <td class="py-2 px-4">{{ $payment->plan->duration }} Bulan</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($payment->subscription_start)->format('d M Y') }}</td>
                        <td class="py-2 px-4">{{ \Carbon\Carbon::parse($payment->subscription_end)->format('d M Y') }}</td>
                        <td class="py-2 px-4">
                            @if (now()->lt($payment->subscription_end) && $payment->status == 'completed')
                                <span class="text-green-600 font-semibold">Aktif</span>
                            @else
                                <span class="text-gray-500">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</main>
@endsection
