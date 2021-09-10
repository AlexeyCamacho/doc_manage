@extends('layouts.base')

@section('title', 'Настройки')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('Настройки') }}</h4></div>
                <div class="card-body">
                    @foreach(config('default_user_settings.keys') as $setting)
                    <div class="form-check form-switch">
                        @if (Auth::user()->setting($setting))
                        <input class="form-check-input" type="checkbox" onchange="changeSetting('{{$setting}}', {{Auth::user()->id}})" checked>
                        @else
                        <input class="form-check-input" type="checkbox" onchange="changeSetting('{{$setting}}', {{Auth::user()->id}})">
                        @endif
                        <label class="form-check-label" for="flexSwitchCheckDefault">{{ trans('settings.'.$setting)  }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('js/settings.js') }}"></script>
