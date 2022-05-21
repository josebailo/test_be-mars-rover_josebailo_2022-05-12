@extends('layouts.default')

@section('content')
    <h1 class="text-4xl font-semibold">{{ __('simulator.welcome_message') }}</h1>
    <h2 class="mt-4 text-xl font-medium">{{ __('simulator.select_mode') }}</h2>

    <section class="mt-20 flex justify-center items-center space-x-10">
        <a href="{{ route('simulator.raw') }}" class="w-40 h-40 flex flex-col space-y-4 justify-center items-center bg-slate-800 rounded-lg shadow-lg transition duration-200 ease-out hover:transform hover:scale-105 hover:shadow-xl hover:bg-slate-900 focus:transform focus:scale-105 focus:shadow-xl focus:bg-slate-900">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-16 h-16" fill="currentColor">
                <path d="M9.372 86.63C-3.124 74.13-3.124 53.87 9.372 41.37C21.87 28.88 42.13 28.88 54.63 41.37L246.6 233.4C259.1 245.9 259.1 266.1 246.6 278.6L54.63 470.6C42.13 483.1 21.87 483.1 9.372 470.6C-3.124 458.1-3.124 437.9 9.372 425.4L178.7 256L9.372 86.63zM544 416C561.7 416 576 430.3 576 448C576 465.7 561.7 480 544 480H256C238.3 480 224 465.7 224 448C224 430.3 238.3 416 256 416H544z" />
            </svg>
            <span>{{ __('simulator.raw_instructions') }}</span>
        </a>
    </section>
@endsection
