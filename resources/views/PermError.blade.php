@extends('layouts.base')

@section('title', 'Ошибка')

@section('content')
<div class="container-fluid p-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-center alert alert-danger">
                {{ ('У Вас недостаточно прав для просмотра данной страницы.') }}
            </h3>
        </div>
    </div>
</div>

@endsection
