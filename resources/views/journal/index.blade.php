@extends('layouts.base')

@section('title', 'Журнал')

@section('content')
    <div class="container border shadow bg-white rounded p-4">
        <div class="row">
            <h2>{{ ('Журнал') }}</h2>
            {{$req->flashOnly(['statuses']);}}
        </div>
        <hr/>
        <form class="row my-3 journal_filter_form" id="journal_filter_form" method="get" action="journal/">
            <div class="row my-1">
                @csrf
                <div class="col">
                    <label for="select-status" class="form-label">Статус</label>
                    <select name="statuses[]" id="select-status" class="form-select select" multiple>
                        @include('inc.option', ['objects' => $statuses, 'id' => 'id', 'name' => 'name', 'childrens' => 'statuses'])
                    </select>
                </div>
                <div class="col">
                    <label for="select-category" class="form-label">Категория</label>
                    <select name="categories[]" id="select-category" class="form-select select" multiple>
                        @include('inc.option', ['objects' => $categories, 'id' => 'id', 'name' => 'name', 'childrens' => 'categories'])
                    </select>
                </div>
                <div class="col">
                    <label for="select-users" class="form-label">Ответственный</label>
                    <select name="users[]" id="select-users" class="form-select select" multiple>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="select-tags" class="form-label">Тэг</label>
                    <select name="tags[]" id="select-tags" class="form-select select" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="row"><div class="col">Дата создания</div></div>
                    <hr class="my-1">
                    <div class="row">
                        <div class="col">
                            <label for="select-status" class="form-label">От</label>
                            <input name="date_from" id="select-date_from" type="date" class="form-control select" value="{{$req->date_from}}">
                        </div>
                        <div class="col">
                            <label for="select-status" class="form-label">До</label>
                            <input name="date_before" id="select-date_before" type="date" class="form-control select" value="{{$req->date_before}}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row"><div class="col">Дедлайн</div></div>
                    <hr class="my-1">
                    <div class="row">
                        <div class="col">
                            <label for="select-status" class="form-label">От</label>
                            <input name="deadline_from" id="select-deadline_from" type="date" class="form-control select" value="{{$req->deadline_from}}">
                        </div>
                        <div class="col">
                            <label for="select-status" class="form-label">До</label>
                            <input name="deadline_before" id="select-deadline_before" type="date" class="form-control select" value="{{$req->deadline_from}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 d-flex justify-content-end">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="only_not_completed" @if(isset($req->only_not_completed)) checked @endif>
                        <label class="form-check-label" for="flexSwitchCheckDefault">Только незавершенные</label>
                    </div>
                        <div class="row mt-2">
                        <button type="submit" class="btn btn-primary" onclick="//filter_jornal('journal_filter_form');">Применить</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div id="table">
              @include('journal.table')
            </div>
        </div>
    </div>

<script type="text/javascript">
var statuses = new vanillaSelectBox('#select-status', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});
var categories = new vanillaSelectBox('#select-category', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});
var users = new vanillaSelectBox('#select-users', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});
var tags = new vanillaSelectBox('#select-tags', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});

var req_statuses = {!! json_encode($req->statuses) !!};
var req_categories = {!! json_encode($req->categories) !!};
var req_users = {!! json_encode($req->users) !!};
var req_tags = {!! json_encode($req->tags) !!};

statuses.setValue(req_statuses);
categories.setValue(req_categories);
users.setValue(req_users);
tags.setValue(req_tags);
</script>


<script src="{{ asset('js/journal.js') }}"></script>
@endsection
