<div class="row">
    <div class="col">
        <h1 class="pl-4 mb-4">{{ ('Список документов') }}</h1>
    </div>
    @can('create-documents')
    <div class="col text-right">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createDocuments">
        <i class="bi bi-plus-circle"></i><span class="m-1">{{ __('Добавить документ') }}</span>
        </button>
    </div>
    @endcan
</div>

@if (!$documents->isEmpty())
<table class="table">
    <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Название</th>
            <th scope="col">Статус</th>
            <th scope="col">Ответственные</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дедлайн</th>
            @can('download-documents')<th scope="col">Скачать</th>@endcan
            @if (session('editMode'))<th scope="col">Настройка</th>@endif
        </tr>
    </thead>
    <tbody>
            @foreach ($documents as $document)
                @if ($document->completed)
                <tr class="table-secondary">
                @else
                    @if ($document->deadline < date("Y-m-d"))
                        <tr class="table-danger">
                    @elseif (date('Y-m-d', strtotime($document->deadline)) == date("Y-m-d"))
                        <tr class="table-warning">
                    @else
                        <tr>
                    @endif
                @endif
                    <td scope="row">{{ $document->id }}</td>
                    <td><a class="underline" href="/doc_manage/documents/{{$document->id}}">{{ \Illuminate\Support\Str::limit($document->name, 25, $end='...') }}</a></td>
                    <td>
                        @if ($document->completed)
                            Документ завершен
                        @elseif (!$document->files->isEmpty())
                            @include('inc.parents', ['object' => $document->files->last()->status, 'name' => 'name', 'parent' => 'parent'])
                        @else
                            Файлы не найдены
                        @endif
                    </td>
                    <td>
                        @foreach ($document->users as $user)
                        {{$user->name}}@if($loop->count > 1 and $loop->remaining != 0), <br>
                        @endif
                        @endforeach
                    </td>
                    <td>{{ $document->created_at }}</td>
                    <td>{{ date('Y-m-d', strtotime($document->deadline)) }}</td>
                    @can('download-documents')<td class="text-center">
                        <button type="button" class="btn btn-outline-secondary"><i class="bi bi-download"></i></button>
                    </td>@endcan
                    @if (session('editMode')) <td> @include('icons.documents') </td>@endif
                </tr>
            @endforeach
    </tbody>
</table>
@else
<h4>Документы в данной категории не найдены</h4>
@endif

