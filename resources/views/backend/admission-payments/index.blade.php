@extends('backend.layouts.app')

@section('title', 'Admission Payments')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div
        class="flex flex-col sm:flex-row
               sm:items-center
               sm:justify-between
               gap-4 mb-8"
    >

        <div>

            <h1 class="text-2xl font-bold text-slate-900">

                Admission Payments

            </h1>

            <p class="mt-1 text-sm text-slate-500">

                Manage and verify admission fee payments.

            </p>

        </div>

    </div>


    {{-- Stats --}}
    <div
        class="grid grid-cols-1 sm:grid-cols-2
               lg:grid-cols-4 gap-4 mb-8"
    >

        <div
            class="bg-white border border-slate-200
                   rounded-2xl p-5"
        >

            <p class="text-sm text-slate-500">
                Total Payments
            </p>

            <p class="mt-2 text-2xl font-bold text-slate-900">
                {{ $total }}
            </p>

        </div>


        <div
            class="bg-yellow-50 border border-yellow-200
                   rounded-2xl p-5"
        >

            <p class="text-sm text-yellow-700">
                Pending
            </p>

            <p class="mt-2 text-2xl font-bold text-yellow-800">
                {{ $pending }}
            </p>

        </div>


        <div
            class="bg-green-50 border border-green-200
                   rounded-2xl p-5"
        >

            <p class="text-sm text-green-700">
                Approved
            </p>

            <p class="mt-2 text-2xl font-bold text-green-800">
                {{ $approved }}
            </p>

        </div>


        <div
            class="bg-red-50 border border-red-200
                   rounded-2xl p-5"
        >

            <p class="text-sm text-red-700">
                Rejected
            </p>

            <p class="mt-2 text-2xl font-bold text-red-800">
                {{ $rejected }}
            </p>

        </div>

    </div>


    {{-- Filters --}}
    <div
        class="bg-white border border-slate-200
               rounded-2xl p-5 mb-6"
    >

        <form
            method="GET"
            class="grid grid-cols-1
                   md:grid-cols-4 gap-4"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Payment No / Transaction ID / Student"
                class="rounded-xl border border-slate-300
                       px-4 py-2.5 outline-none
                       focus:border-indigo-500"
            >


            <select
                name="status"
                class="rounded-xl border border-slate-300
                       px-4 py-2.5 bg-white outline-none"
            >

                <option value="">
                    All Status
                </option>

                <option
                    value="pending"
                    {{ request('status') === 'pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="approved"
                    {{ request('status') === 'approved' ? 'selected' : '' }}
                >
                    Approved
                </option>

                <option
                    value="rejected"
                    {{ request('status') === 'rejected' ? 'selected' : '' }}
                >
                    Rejected
                </option>

            </select>


            <button
                type="submit"
                class="rounded-xl bg-indigo-600
                       text-white font-semibold
                       px-5 py-2.5
                       hover:bg-indigo-700"
            >

                Filter

            </button>


            <a
                href="{{ route('admin.admission-payments.index') }}"
                class="rounded-xl border
                       border-slate-300
                       text-slate-700
                       font-semibold
                       px-5 py-2.5
                       text-center"
            >

                Reset

            </a>

        </form>

    </div>


    {{-- Table --}}
    <div
        class="bg-white border border-slate-200
               rounded-2xl overflow-hidden"
    >

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50
                              border-b border-slate-200">

                    <tr>

                        <th class="text-left px-5 py-4">
                            Payment
                        </th>

                        <th class="text-left px-5 py-4">
                            Student
                        </th>

                        <th class="text-left px-5 py-4">
                            Amount
                        </th>

                        <th class="text-left px-5 py-4">
                            Method
                        </th>

                        <th class="text-left px-5 py-4">
                            Transaction
                        </th>

                        <th class="text-left px-5 py-4">
                            Status
                        </th>

                        <th class="text-right px-5 py-4">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($payments as $payment)

                        <tr class="hover:bg-slate-50">

                            <td class="px-5 py-4">

                                <p class="font-semibold
                                          text-slate-900">

                                    {{ $payment->payment_no }}

                                </p>

                                <p class="text-xs text-slate-500 mt-1">

                                    {{ $payment->created_at->format('d M Y h:i A') }}

                                </p>

                            </td>


                            <td class="px-5 py-4">

                                @if($payment->application)

                                    <p class="font-semibold">

                                        {{ $payment->application->student_name }}

                                    </p>

                                    <p class="text-xs text-slate-500">

                                        {{ $payment->application->application_no }}

                                    </p>

                                @else

                                    <span class="text-red-500">
                                        Deleted Application
                                    </span>

                                @endif

                            </td>


                            <td class="px-5 py-4 font-bold">

                                ৳ {{ number_format($payment->amount, 2) }}

                            </td>


                            <td class="px-5 py-4">

                                {{ strtoupper($payment->payment_method) }}

                            </td>


                            <td class="px-5 py-4">

                                <span class="font-mono text-xs">

                                    {{ $payment->transaction_id }}

                                </span>

                            </td>


                            <td class="px-5 py-4">

                                @if($payment->status === 'approved')

                                    <span
                                        class="px-3 py-1 rounded-full
                                               text-xs font-semibold
                                               bg-green-100
                                               text-green-700"
                                    >
                                        Approved
                                    </span>

                                @elseif($payment->status === 'pending')

                                    <span
                                        class="px-3 py-1 rounded-full
                                               text-xs font-semibold
                                               bg-yellow-100
                                               text-yellow-700"
                                    >
                                        Pending
                                    </span>

                                @else

                                    <span
                                        class="px-3 py-1 rounded-full
                                               text-xs font-semibold
                                               bg-red-100
                                               text-red-700"
                                    >
                                        Rejected
                                    </span>

                                @endif

                            </td>


                            <td class="px-5 py-4 text-right">

                                <a
                                    href="{{ route('admin.admission-payments.show', $payment) }}"
                                    class="inline-flex
                                           px-4 py-2 rounded-lg
                                           bg-indigo-600 text-white
                                           text-xs font-semibold
                                           hover:bg-indigo-700"
                                >

                                    View

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-5 py-12
                                       text-center
                                       text-slate-500"
                            >

                                No payment found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($payments->hasPages())

            <div class="p-5 border-t">

                {{ $payments->links() }}

            </div>

        @endif

    </div>

</div>

@endsection