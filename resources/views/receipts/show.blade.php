@extends('layouts.macos')
@section('page_title', 'Receipt Details')
@section('content')

<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Receipt Details</h2>
            <div class="flex gap-2">
                <a href="{{ route('receipts.print', $receipt->id) }}" target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Print Receipt
                </a>
                <a href="{{ route('receipts.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="font-semibold text-lg mb-3 text-gray-700">Receipt Information</h3>
                <p class="mb-2"><strong>Receipt No:</strong> {{ $receipt->unique_code }}</p>
                <p class="mb-2"><strong>Receipt Date:</strong> {{ $receipt->receipt_date ? $receipt->receipt_date->format('d-m-Y') : '-' }}</p>
                <p class="mb-2"><strong>Company Name:</strong> {{ $receipt->company_name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-lg mb-3 text-gray-700">Payment Information</h3>
                <p class="mb-2"><strong>Received Amount:</strong> ₹{{ number_format($receipt->received_amount, 2) }}</p>
                <p class="mb-2"><strong>Payment Type:</strong> {{ $receipt->payment_type ?? '-' }}</p>
                <p class="mb-2"><strong>Trans Code:</strong> {{ $receipt->trans_code ?? '-' }}</p>
            </div>
        </div>

        @if($receipt->narration)
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 text-gray-700">Narration</h3>
            <p class="text-gray-600">{{ $receipt->narration }}</p>
        </div>
        @endif

        @if($receipt->invoice_ids && count($receipt->invoice_ids) > 0)
        <div class="mb-6">
            <h3 class="font-semibold text-lg mb-3 text-gray-700">Linked Invoices</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Invoice No</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($receipt->invoices() as $invoice)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $invoice->unique_code }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-right">₹{{ number_format($invoice->final_amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
