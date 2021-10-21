@extends('layouts.base')

@section('title', 'Логи')

@section('content')
    <div class="container border shadow bg-white rounded p-4">
        <div class="row">
            <h2>{{ ('Логи') }}</h2>
        </div>
        <hr/>
        <form class="row my-3 journal_filter_form" id="journal_filter_form" method="get" action="logs">
            <div class="row my-1">
                @csrf
                <div class="col">
                    <label for="select-actions" class="form-label">Действие</label>
                    <select name="actions[]" id="select-actions" class="form-select select" multiple>
                        @foreach ($actions as $action)
                            <option value="{{$action->description}}">{{ __('logs.action.' . $action->description)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="select-users" class="form-label">Пользователь</label>
                    <select name="users[]" id="select-users" class="form-select select" multiple>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="select-object" class="form-label">Объект</label>
                    <select name="object[]" id="select-object" class="form-select select" multiple>
                        @foreach ($objects as $object)
                            <option value="{{$object->subject_type}}">{{ __('logs.models.' . $object->subject_type)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <div class="row"><div class="col">Дата и время:</div></div>
                    <hr class="my-1">
                    <div class="row">
                        <div class="col">
                            <label for="select-status" class="form-label">От</label>
                            <input name="date_from" id="select-date_from" type="datetime-local" class="form-control select" value="{{$req->date_from}}">
                        </div>
                        <div class="col">
                            <label for="select-status" class="form-label">До</label>
                            <input name="date_before" id="select-date_before" type="datetime-local" class="form-control select" value="{{$req->date_before}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 d-flex justify-content-end">
                <div class="col-auto">
                    <div class="row mt-2">
                        <button type="submit" class="btn btn-primary">Применить</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div id="table">
              @include('logs.table')
            </div>
        </div>
    </div>

<script type="text/javascript">
var actions = new vanillaSelectBox('#select-actions', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});
var users = new vanillaSelectBox('#select-users', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});
var object = new vanillaSelectBox('#select-object', {"translations": { "all": "Все", "items": "предметы","selectAll":"Выбрать все","clearAll":"Очистить все"}});


var req_actions = {!! json_encode($req->actions) !!};
var req_users = {!! json_encode($req->users) !!};
var req_object = {!! json_encode($req->object) !!};


actions.setValue(req_actions);
users.setValue(req_users);
object.setValue(req_object);

document.querySelectorAll('.table thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
</script>


@endsection
