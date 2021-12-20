@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Contacts') }}
@endsection


@section('content')

    {{ Form::open(['url' => route('omega-plugins-bundle.contacts.update'), 'method' => 'post', 'class' => 'form-horizontal main-form']) }}

    <x-oix-card title="{{ __('reCAPTCHA v3') }}" subtitle="{{ __('Configure your reCAPTCHA crendentials') }}">
        <div class="alert alert-info">
            Get your credentials from
            <a href="https://www.google.com/recaptcha/admin#list">Google reCAPTCHA panel</a>.
        </div>

        {{ Form::otext('key_site', $key_site ?? null, ['label' => __('Site key'), 'helper' => __('This key is used to invoke reCAPTCHA service on your site')]) }}
        {{ Form::otext('key_secret', $key_secret ?? null, ['label' => __('Secret key'), 'helper' => __('This key authorizes communication between your application backend and the reCAPTCHA server to verify the user\'s response. Keep this key secret')]) }}


        {{ Form::oback() }}
        {{ Form::osubmit() }}

    </x-oix-card>

    {{ Form::close() }}

@endsection

