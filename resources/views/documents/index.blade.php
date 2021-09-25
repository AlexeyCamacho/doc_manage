@extends('layouts.base')

@section('title', 'Документ')

@section('content')
<div class="container">
    @if ($document) 
    <div class="row">
        <div class="col-md-3 border text-center"><img src="{{asset('storage/pdf4.jpg')}}" class="img-fluid"></div>
        <div class="col-md-9 border border-left-0">
            <h5 class="mt-3">{{$document->name}}</h5>
            <hr>
            <h5>Ответственные: 
                @foreach ($document->users as $user)
                    {{$user->name}}@if($loop->count > 1 and $loop->remaining != 0), @endif
                @endforeach
            </h5>
            <h5>Дедлайн: {{ date('Y-m-d', strtotime($document->deadline)) }}</h5>
            <h5>Создан: {{$document->created_at}}</h5>
        </div>  
    </div>
    <div class="row border border-top-0">
        <div class="col py-3"><h6>{{$document->description}}</h6></div> 
    </div>
    <div class="row border border-top-0">
        <div class="col">
            @if(!$document->files->isEmpty())
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Исполнитель</th>
                            <th scope="col">Дата загрузки</th>
                            <th scope="col">Дедлайн</th>
                            @can('download-documents')<th scope="col" class="text-center">Скачать</th>@endcan
                            @if (session('editMode'))<th scope="col " class="text-center">Настройка</th>@endif
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($document->files as $file)
                                @if ($loop->last && !$document->completed && $document->deadline)
                                    @if ($file->deadline < date("Y-m-d"))
                                        <tr class="table-danger">
                                    @elseif ($file->deadline == date("Y-m-d"))
                                        <tr class="table-warning">
                                    @else
                                        <tr>
                                    @endif
                                @else
                                    <tr>
                                @endif
                                
                                <td scope="row">{{ $file->id }}</td>
                                <td>@include('inc.parents', ['object' => $file->status, 'name' => 'name', 'parent' => 'parent'])</td>
                                <td>{{ $file->user->name }}</td>
                                <td>{{ $file->created_at }}</td>
                                <td>
                                    @if ($file->deadline != null)
                                    {{ $file->deadline }}
                                    @else
                                    Неопределён
                                    @endif
                                </td>
                                @can('download-documents')<td class="text-center">
                                    <button type="button" class="btn btn-outline-secondary"><i class="bi bi-download"></i></button>
                                </td>@endcan
                                @if (session('editMode')) <td class="text-center"> @include('icons.documents') </td>@endif
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            @else
                <h4 class="text-center alert">
                    {{ ('Файлы не найдены.') }}
                </h4>
            @endif
        </div> 
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
