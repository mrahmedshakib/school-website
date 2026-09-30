@extends('frontend.layouts.app')
@section('title', 'মিশন ও ভিশন')
@section('meta_description', 'বিদ্যালয়ের মিশন ও ভিশন।')
@section('content')

<section class="py-20 bg-gray-50">

<div class="max-w-7xl mx-auto px-4">

    <div class="text-center mb-12">

        <span class="inline-block px-4 py-2 mb-4 text-sm font-semibold rounded-full bg-white text-gray-700">
            মিশন ও ভিশন
        </span>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900">
            আমাদের মিশন ও ভিশন
        </h1>

    </div>


    @if($missionVision)

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Mission --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">

                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gray-900 text-white mb-6">
                    <span class="text-2xl font-bold">
                        M
                    </span>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ $missionVision->mission_title }}
                </h2>

                <p class="text-gray-600 leading-8">
                    {!! nl2br(e($missionVision->mission_description)) !!}
                </p>

            </div>


            {{-- Vision --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">

                <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-gray-900 text-white mb-6">
                    <span class="text-2xl font-bold">
                        V
                    </span>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ $missionVision->vision_title }}
                </h2>

                <p class="text-gray-600 leading-8">
                    {!! nl2br(e($missionVision->vision_description)) !!}
                </p>

            </div>

        </div>

    @else

        <div class="bg-white rounded-3xl p-10 text-center shadow-sm border border-gray-100">

            <p class="text-gray-500 text-lg">
                মিশন ও ভিশনের তথ্য বর্তমানে পাওয়া যাচ্ছে না।
            </p>

        </div>

    @endif

</div>

</section>

@endsection
