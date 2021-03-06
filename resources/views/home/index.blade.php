@extends('layouts.base')

@section('title', 'Личный кабинет')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Личный кабинет') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ ('Добро пожаловать, ') . Auth::user()->name . ('!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
