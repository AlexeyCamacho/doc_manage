@extends('layouts.base')

@section('title', 'Статусы')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1>{{ ('Статусы') }}</h1>
            <table class="table table-striped my-4">
                <thead>
                    <tr>
                        <th scope="col">{{ ('ID') }}</th>
                        <th scope="col">{{ ('Статус') }}</th>
                        <th scope="col">{{ ('Действия') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statuses as $status)
                        <tr>
                            <th scope="row"> {{ $status->id }} </th>
                            <td>
                              <div class="name_status" id="name_status_{{$status->id}}">
                                @include('inc.parents', ['object' => $status->parent, 'name' => 'name', 'parent' => 'parent'])
                                <b>{{$status->name}}</b>
                              </div>
                              <div class="edit_status" id="edit_status_{{$status->id}}">

                              </div>
                            </td>
                            <td> @include('icons.statuses') </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $statuses->links() }}

        </div>
        <div class="col-md-3">

            @can('management-statuses')
              <button type="button" class="btn btn-outline-primary status_add_button"
              onclick="
                  display_block('status_add_form', 'status_add_button');">
                  <i class="bi bi-plus"></i>
              </button>
              <button type="button" class="btn btn-outline-danger d-none status_add_form"
              onclick="
                  display_block('status_add_button', 'status_add_form');
                  rm_class('create', 'is-invalid');
                  clear_class('errors-create');">
                  <i class="bi bi-x-lg"></i>
              </button>
              <button type="button" class="btn btn-outline-success d-none status_add_form"
              onclick="
                  rm_class('create', 'is-invalid');
                  clear_class('errors-create');
                  display_block('spinner-border', 'none');
                  ajax('status_add_form', '/doc_manage/statuses/create', 'create-');">
                  <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" ></span>
                  <i class="bi bi-check-lg"></i>
              </button>

              <form class="row my-3 d-none status_add_form" id="status_add_form">
                  @csrf
                  <div class="col">
                      <div class="mb-3">
                          <label for="create-status" class="col-form-label">Статус:</label>
                          <select class="form-select create" id="create-status" name="status">
                              <option value="" selected>/</option>
                              @include('inc.option', ['objects' => $statusesOption, 'id' => 'id', 'name' => 'name', 'childrens' => 'statuses'])
                          </select>
                          <x-print-errors action="create" field="status"></x-print-errors>
                      </div>
                      <div class="mb-3">
                          <input type="text" class="form-control create" id="create-new_status" name="new_status">
                          <x-print-errors action="create" field="new_status"></x-print-errors>
                      </div>
                  </div>
              </form>
            @endcan
        </div>
    </div>
</div>

@include('statuses.edit_modal')
@include('statuses.delete_modal')

@endsection
