@extends('layouts.base')

@section('title', 'Теги')

@section('content')
<div class="container-fluid border shadow bg-white rounded p-3">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
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
                            <td>
                              <div class="name_tag" id="name_tag_{{$tag->id}}">
                                {{ $tag->name }}
                              </div>
                              <div class="edit_tag" id="edit_tag_{{$tag->id}}">

                              </div>
                            </td>
                            <td> @include('icons.tags') </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tags->links() }}

        </div>
        <div class="col-md-3">

            @can('management-tags')
              <button type="button" class="btn btn-outline-primary tag_add_button"
              onclick="
                  display_block('tag_add_form', 'tag_add_button');">
                  <i class="bi bi-plus"></i>
              </button>
              <button type="button" class="btn btn-outline-danger d-none tag_add_form"
              onclick="
                  display_block('tag_add_button', 'tag_add_form');
                  rm_class('create', 'is-invalid');
                  clear_class('errors-create');">
                  <i class="bi bi-x-lg"></i>
              </button>
              <button type="button" class="btn btn-outline-success d-none tag_add_form"
              onclick="
                  rm_class('create', 'is-invalid');
                  clear_class('errors-create');
                  display_block('spinner-border', 'none');
                  ajax('tag_add_form', '/doc_manage/tags/create', 'create-');">
                  <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" ></span>
                  <i class="bi bi-check-lg"></i>
              </button>

              <form class="row my-3 d-none tag_add_form" id="tag_add_form">
                  @csrf
                  <div class="col">
                      <label for="create-tag" class="form-label">Тег</label>
                      <input name="tag" id="create-tag" type="text" class="form-control create" placeholder="Договор">
                      <x-print-errors action="create" field="tag"></x-print-errors>
                  </div>
              </form>
            @endcan
        </div>
    </div>
</div>

<div class="d-none">
  <form class="row my-1 tag_edit_form" id="tag_edit_form_pattern">
      @csrf
      <input name="id" type="hidden" value="" class="tag-id">
      <div class="col-8">
      <input name="tag" type="text" class="form-control edit tag-name">
      <x-print-errors action="edit" field="tag"></x-print-errors>
    </div>
      <div class="col-2">
      <button type="button" class="btn btn-outline-success tag_edit_form"
      onclick="rm_class('edit', 'is-invalid');
      clear_class('errors-edit');
      ajax('tag_edit_form', '/doc_manage/tags/edit', 'edit-');">
          <i class="bi bi-check-lg"></i>
      </button>
      </div>
  </form>
</div>


<script src="{{ asset('js/tags.js') }}"></script>

@include('tags.delete_modal')

@endsection
