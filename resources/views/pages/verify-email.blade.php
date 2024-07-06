@extends('layouts.layout')

@section('content')
    <div class="flex flex-col justify-center items-center">
        <div class="font-regular relative block w-full rounded-lg bg-gray-900 p-4 text-base leading-5 text-white opacity-70">
            Verify your account. An email has been sent to you for notification!
        </div>

        <div class="w-full pt-5 px-4 mb-8 mx-auto ">
            <div class="text-sm text-gray-700 py-1">
                <p>If you didn't receive the email, please resend it</p>
                <form action="{{route('verification.send')}}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 text-indigo-600 bg-indigo-50 rounded-lg duration-150 hover:bg-indigo-100 active:bg-indigo-200">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
