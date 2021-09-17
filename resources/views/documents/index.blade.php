@extends('layouts.base')

@section('title', 'Документ')

@section('content')
<div class="container">
    @if ($document) 
    <div class="row">
        <div class="col-md-3 border"><img src="{{asset('storage/closed4.jpg')}}" class="img-fluid"></div>
        <div class="col-md-9 border border-left-0">
            <h5>{{$document->name}}</h5>
            <h5>Ответственные: 
                @foreach ($document->users as $user)
                    {{$user->name}}@if($loop->count > 1 and $loop->remaining != 0), @endif
                @endforeach
            </h5>
            <h5>Дедлайн: {{ date('Y-m-d', strtotime($document->deadline)) }}</h5>
            <h5>Создан: {{$document->created_at}}</h5>
        </div>  
    </div>
    <div class="row">
        <div class="col border border-top-0">{{$document->description}}</div> 
    </div>
    <div class="row">
        <div class="col border border-top-0">Таблица</div> 
    </div>
    @else
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-center alert alert-danger">
                {{ ('Документ не найден.') }}
            </h3>
        </div>
    </div>
    @endif
</div>
@endsection
