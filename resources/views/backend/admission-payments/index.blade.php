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

            <table class="w-full text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="text-left px-3 py-2.5 w-36">পেমেন্ট নম্বর</th>
                        <th class="text-left px-3 py-2.5">শিক্ষার্থী ও আবেদন</th>
                        <th class="text-left px-3 py-2.5 w-24">পরিমাণ</th>
                        <th class="text-left px-3 py-2.5 w-20">মেথড</th>
                        <th class="text-left px-3 py-2.5 w-36">ট্রানজ্যাকশন আইডি</th>
                        <th class="text-center px-3 py-2.5 w-24">স্ট্যাটাস</th>
                        <th class="text-right px-3 py-2.5 w-20">অ্যাকশন</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-3 py-2.5">
                                <p class="font-bold text-slate-900 font-mono text-[11px]">
                                    {{ $payment->payment_no }}
                                </p>
                                <p class="text-[10px] text-slate-400 mt-0.5">
                                    {{ $payment->created_at->format('d M, Y h:i A') }}
                                </p>
                            </td>

                            <td class="px-3 py-2.5">
                                @if($payment->application)
                                    <p class="font-bold text-slate-900 line-clamp-1">
                                        {{ $payment->application->student_name }}
                                    </p>
                                    <p class="text-[10px] text-emerald-700 font-mono">
                                        {{ $payment->application->application_no }}
                                    </p>
                                @else
                                    <span class="text-rose-500 text-[11px]">মুছে ফেলা আবেদন</span>
                                @endif
                            </td>

                            <td class="px-3 py-2.5 font-bold text-slate-900">
                                ৳ {{ number_format($payment->amount, 2) }}
                            </td>

                            <td class="px-3 py-2.5 uppercase font-mono text-[11px] text-slate-600">
                                {{ $payment->payment_method }}
                            </td>

                            <td class="px-3 py-2.5">
                                <span class="font-mono text-[11px] text-slate-700 bg-slate-100 px-1.5 py-0.5 rounded">
                                    {{ $payment->transaction_id }}
                                </span>
                            </td>

                            <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                @if($payment->status === 'approved')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Approved
                                    </span>
                                @elseif($payment->status === 'pending')
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                        Pending
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                                        Rejected
                                    </span>
                                @endif
                            </td>

                            <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                <a href="{{ route('admin.admission-payments.show', $payment) }}"
                                   class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold hover:bg-emerald-100 transition">
                                    বিস্তারিত
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