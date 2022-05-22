@extends('layouts.default')

@section('content')
    <h1 class="text-4xl font-semibold">{{ env('APP_NAME') }}</h1>
    <h2 class="mt-4 text-xl font-medium">{{ __('simulator.raw_instructions_mode') }}</h2>

    <section class="mt-20">
        <form action="{{ route('simulate') }}" method="POST">
            @csrf

            <fieldset>
                <label for="instructions">{{ __('simulator.instructions') }}:</label>
                <textarea name="instructions" id="instructions" placeholder="{{ __('simulator.instructions_placeholder') }}" class="mt-4 w-full h-36 px-3 py-2 bg-white text-gray-700 font-mono rounded" required autofocus>{{ old('instructions', session('instructions')) }}</textarea>
            </fieldset>

            <div class="mt-4 flex flex-row-reverse justify-between items-center gap-2">
                <button type="submit" class="flex-shrink-0 px-3 py-2 bg-slate-800 rounded transition duration-200 ease-out hover:bg-slate-900 focus:bg-slate-900">{{ __('simulator.send') }}</button>

                @if ($errors->any())
                    <div>
                        @foreach ($errors->all() as $error)
                            <p class="text-red-500 text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </form>

        @if (session('output'))
            <div class="mt-20">
                <h3>{{ __('simulator.simulation_result') }}:</h3>
                <pre class="mt-4 w-full min-h-36 px-3 py-2 bg-white text-gray-700 rounded">{{ session('output') }}</pre>
            </div>
        @endif
    </section>
@endsection
