@extends('layouts.base')

@section('title', 'Права')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>{{ ('Права') }}</h1>
            <table class="table table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">{{ ('ID') }}</th>
                        <th scope="col">{{ ('Право') }}</th>
                        <th scope="col">{{ ('Обозначение') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $permission)
                        <tr>
                            <th scope="row"> {{ $permission->id }} </th>
                            <td> {{ $permission->name }} </td>
                            <td> {{ $permission->slug }}</td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
