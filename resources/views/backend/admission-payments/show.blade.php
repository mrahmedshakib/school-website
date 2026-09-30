@extends('backend.layouts.app')

@section('title', 'Payment Details')

@section('content')

<div class="max-w-5xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row
                sm:items-center
                sm:justify-between
                gap-4 mb-8">

        <div>

            <h1 class="text-2xl font-bold text-slate-900">

                Payment Details

            </h1>

            <p class="mt-1 text-sm text-slate-500">

                {{ $admissionPayment->payment_no }}

            </p>

        </div>


        <a
            href="{{ route('admin.admission-payments.index') }}"
            class="inline-flex justify-center
                   px-5 py-2.5 rounded-xl
                   border border-slate-300
                   text-slate-700 font-semibold"
        >

            ← Back

        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div
            class="mb-6 rounded-xl
                   bg-green-50 border border-green-200
                   p-4 text-sm text-green-700"
        >

            {{ session('success') }}

        </div>

    @endif


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Payment --}}
        <div
            class="lg:col-span-2
                   bg-white border border-slate-200
                   rounded-2xl overflow-hidden"
        >

            <div
                class="px-6 py-5 bg-slate-50
                       border-b border-slate-200"
            >

                <h2 class="font-bold text-slate-900">

                    Payment Information

                </h2>

            </div>


            <div class="p-6 space-y-5">

                <div class="grid grid-cols-1
                            sm:grid-cols-2 gap-5">

                    <div>

                        <p class="text-xs text-slate-500">
                            Payment No.
                        </p>

                        <p class="mt-1 font-bold">

                            {{ $admissionPayment->payment_no }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Amount
                        </p>

                        <p class="mt-1 text-xl font-bold">

                            ৳ {{ number_format($admissionPayment->amount, 2) }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Payment Method
                        </p>

                        <p class="mt-1 font-semibold">

                            {{ strtoupper($admissionPayment->payment_method) }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Account Number
                        </p>

                        <p class="mt-1 font-semibold">

                            {{ $admissionPayment->account_number ?: 'N/A' }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Transaction ID
                        </p>

                        <p class="mt-1 font-mono font-bold">

                            {{ $admissionPayment->transaction_id }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Submitted
                        </p>

                        <p class="mt-1 font-semibold">

                            {{ $admissionPayment->created_at->format('d M Y h:i A') }}

                        </p>

                    </div>

                </div>


                {{-- Proof --}}
                @if($admissionPayment->payment_proof)

                    <div
                        class="pt-5 border-t
                               border-slate-100"
                    >

                        <p class="text-sm font-semibold
                                  text-slate-700 mb-3">

                            Payment Proof

                        </p>


                        <a
                            href="{{ asset($admissionPayment->payment_proof) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2
                                   px-5 py-2.5 rounded-xl
                                   bg-slate-900 text-white
                                   text-sm font-semibold"
                        >

                            📄 View Payment Proof

                        </a>

                    </div>

                @endif

            </div>

        </div>


        {{-- Application --}}
        <div
            class="bg-white border border-slate-200
                   rounded-2xl p-6"
        >

            <h2 class="font-bold text-slate-900">

                Applicant

            </h2>


            @if($admissionPayment->application)

                <div class="mt-5 space-y-4">

                    <div>

                        <p class="text-xs text-slate-500">
                            Application No.
                        </p>

                        <p class="font-bold mt-1">

                            {{ $admissionPayment->application->application_no }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Student Name
                        </p>

                        <p class="font-semibold mt-1">

                            {{ $admissionPayment->application->student_name }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Class
                        </p>

                        <p class="font-semibold mt-1">

                            {{ $admissionPayment->application->class }}

                        </p>

                    </div>


                    <div>

                        <p class="text-xs text-slate-500">
                            Guardian Phone
                        </p>

                        <p class="font-semibold mt-1">

                            {{ $admissionPayment->application->guardian_phone }}

                        </p>

                    </div>

                </div>

            @endif

        </div>

    </div>


    {{-- Status Update --}}
    <div
        class="mt-6 bg-white border
               border-slate-200
               rounded-2xl overflow-hidden"
    >

        <div
            class="px-6 py-5 bg-slate-50
                   border-b border-slate-200"
        >

            <h2 class="font-bold text-slate-900">

                Payment Verification

            </h2>

        </div>


        <form
            action="{{ route('admin.admission-payments.status', $admissionPayment) }}"
            method="POST"
            class="p-6"
        >

            @csrf
            @method('PUT')


            <div class="grid grid-cols-1
                        md:grid-cols-2 gap-6">

                <div>

                    <label
                        class="block text-sm
                               font-semibold
                               text-slate-700 mb-2"
                    >

                        Status

                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl
                               border border-slate-300
                               px-4 py-3 bg-white"
                    >

                        <option
                            value="pending"
                            {{ $admissionPayment->status === 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="approved"
                            {{ $admissionPayment->status === 'approved' ? 'selected' : '' }}
                        >
                            Approved
                        </option>

                        <option
                            value="rejected"
                            {{ $admissionPayment->status === 'rejected' ? 'selected' : '' }}
                        >
                            Rejected
                        </option>

                    </select>

                </div>


                <div>

                    <label
                        class="block text-sm
                               font-semibold
                               text-slate-700 mb-2"
                    >

                        Admin Note

                    </label>

                    <textarea
                        name="admin_note"
                        rows="3"
                        placeholder="Payment verification note..."
                        class="w-full rounded-xl
                               border border-slate-300
                               px-4 py-3"
                    >{{ old('admin_note', $admissionPayment->admin_note) }}</textarea>

                </div>

            </div>


            <div class="mt-6 flex justify-end">

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl
                           bg-indigo-600 text-white
                           font-semibold
                           hover:bg-indigo-700"
                >

                    ✓ Update Payment Status

                </button>

            </div>

        </form>

    </div>

</div>

@endsection