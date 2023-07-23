
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Mobile Phone') }}</div>
                    <div class="card-body">
                        {{ __('Thanks for signing up! Before getting started, you need to verify your mobile phone number.') }}
                        {{ __('Please enter the OTP sent to your number:') }} {{ auth()->user()->mobile_number }}
                        <form method="POST" action="{{ route('verification.verify-mobile') }}">
                            @csrf

                            <div>
                                <label for="code" :value="__('Code')">

                                <input id="code" class="form-control" type="text" name="code" :value="old('code')" required autofocus />
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                    {{ __('Verify') }}
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

