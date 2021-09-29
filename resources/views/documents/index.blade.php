@extends('layouts.base')

@section('title', 'Документ')

@section('content')
<div class="container border shadow bg-white rounded p-4">
    @if ($document) 
    <div class="row">
        <div class="col-md-3 border text-center"><img src="{{asset('storage/pdf4.jpg')}}" class="img-fluid"></div>
        <div class="col-md-9 border border-left-0">
            <div class="row">
                <div class="col mt-1"><h5 class="mt-3">{{$document->name}}</h5></div>
                <div class="col text-right mt-2">
                    <a type="button" class="btn btn-outline-secondary" href="{{url()->previous();}}">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="bi bi-three-dots"></i>
                    </button>
                </div>
            </div>
            <hr class="my-2">
                <h5>Ответственные: 
                    @foreach ($document->users as $user)
                        {{$user->name}}@if($loop->count > 1 and $loop->remaining != 0), @endif
                    @endforeach
                </h5>
                <h5>Дедлайн: 
                    @if ($document->deadline != null)
                        {{ $document->deadline }}
                        @else
                        Неопределён
                    @endif
                </h5>
            <div class="row">
                <div class="col">
                    <h5>Создан: {{$document->created_at}}</h5>
                </div>
                <div class="col text-right mb-2">
                    <button type="button" class="btn btn-outline-primary">
                        </i>Добавить файл
                    </button>
                </div>
            </div>
        </div>  
    </div>
    <div class="row border border-top-0">
        <div class="col py-3"><h6>{{$document->description}}</h6></div> 
    </div>
    <div class="row border border-top-0">
        <div class="col px-0">
            @if(!$document->files->isEmpty())
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Статус</th>
                            <th scope="col">Исполнитель</th>
                            <th scope="col">Дата загрузки</th>
                            <th scope="col">Дедлайн</th>
                            @can('download-documents')<th scope="col" class="text-center">Предпр./Скачать</th>@endcan
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
                                <td class="text-center">
                                @can('download-documents')
                                <div class="btn-group text-center" role="group">
                                    <a type="button" class="btn btn-outline-secondary" href="/doc_manage/files/preview/{{$file->id}}" target="_blank">
                                        <i class="bi bi-file-earmark-text"></i></a>
                                    <a type="button" class="btn btn-outline-secondary" href="/doc_manage/files/download/{{$file->id}}">
                                        <i class="bi bi-download" ></i></a>
                                </div>
                                @endcan
                                </td>
                                @if (session('editMode')) <td class="text-center"> @include('icons.documents') </td>@endif
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
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
