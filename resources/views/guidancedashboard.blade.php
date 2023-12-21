@extends('layouts.guidancelayout')

@section('content')
    <div
        class="w-screen h-screen laptop:h-screen xl:w-full xl:h-full flex flex-col justify-center items-center bg-gradient-to-b from-slate-200 via-slate-100 to-slate-300 relative overflow-x-hidden">
        <!-- Introduction -->
        <h1
            class="text-5xl font-extrabold mb-6 text-slate-800 tracking-wide uppercase text-center animate__animated animate__fadeInDown">
            Welcome to MindScape
            {{ strtoupper(explode(' ', auth()->user()->name)[0]) }}!
        </h1>

        <div class="text-xl mb-8 w-3/4 text-center">
            <p class="p-5 text-slate-800 animate__animated animate__pulse">
                Explore self-discovery, where your thoughts matter, emotions are
                valued, and a healthier mind takes center stage.
            </p>
        </div>
    </div>
@endsection
