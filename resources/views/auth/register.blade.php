@extends('layouts.auth')

<div class="register-box" style="width: 400px">
    <div class="register-box-body">
        <x-guest-layout>
            <x-authentication-card>
                <x-slot name="logo">
                    <div class="login-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo_small.png') }}" alt="logo.png" width="50" style="background-color: #2E4492; border-radius: 50px;">
                        </a>
                    </div>
                </x-slot>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group has-feedback mb-3 @error('name') has-error @enderror">
                        <input type="text" name="name" class="form-control" placeholder="Name" required value="{{ old('name') }}" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @else
                        <span class="help-block with-errors"></span>
                        @enderror
                    </div>

                    <div class="form-group has-feedback mb-3 @error('email') has-error @enderror">
                        <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @error('email')
                        <span class="help-block">{{ $message }}</span>
                        @else
                        <span class="help-block with-errors"></span>
                        @enderror
                    </div>

                    <div class="form-group has-feedback mb-3 @error('password') has-error @enderror">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @error('password')
                        <span class="help-block">{{ $message }}</span>
                        @else
                        <span class="help-block with-errors"></span>
                        @enderror
                    </div>

                    <div class="form-group has-feedback mb-3 @error('password_confirmation') has-error @enderror">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @error('password_confirmation')
                        <span class="help-block">{{ $message }}</span>
                        @else
                        <span class="help-block with-errors"></span>
                        @enderror
                    </div>

                    <!-- <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div> -->

                    <!-- <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div> -->

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                    @endif

                    <div class="row">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 col-xs-8 mb-2" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">{{ __('Register') }}</button>
                        </div>

                        <!-- <x-button class="ms-4">
                            {{ __('Register') }}
                        </x-button> -->
                    </div>
                </form>
            </x-authentication-card>
        </x-guest-layout>
    </div>
</div>