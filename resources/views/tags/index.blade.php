@extends('layouts.base')

@section('title', 'Теги')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>{{ ('Теги') }}</h1>
            <table class="table table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">{{ ('ID') }}</th>
                        <th scope="col">{{ ('Тег') }}</th>
                        <th scope="col">{{ ('Действия') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <th scope="row"> {{ $tag->id }} </th>
                            <td> {{ $tag->name }} </td>
                            <td> @include('icons.tags') </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tags->links() }}

            @can('management-tags')
                <button role="button" class="btn btn-outline-primary">
                    <i class="bi bi-plus-circle"></i><span class="m-1">{{ __('Добавить тег') }}</span>
                </button>
            @endcan
        </div>
    </div>
</div>

@endsection
