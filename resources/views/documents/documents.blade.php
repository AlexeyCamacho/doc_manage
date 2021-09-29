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
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Статус</th>
            <th scope="col">Ответственные</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Дедлайн</th>
            @can('download-documents')<th scope="col" class="text-center">Предпр./Скачать</th>@endcan
            @if (session('editMode'))<th scope="col">Настройка</th>@endif
        </tr>
    </thead>
    <tbody>
            @foreach ($documents as $document)
                @if ($document->completed)
                <tr class="table-secondary">
                @else
                    @if ($document->deadline && $document->deadline < date("Y-m-d"))
                        <tr class="table-danger">
                    @elseif ($document->deadline != null && $document->deadline == date("Y-m-d"))
                        <tr class="table-warning">
                    @else
                        <tr>
                    @endif
                @endif
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
                    <td>
                        @if ($document->deadline != null)
                        {{ $document->deadline }}
                        @else
                        Неопределён
                        @endif
                    </td>
                    <td class="text-center">
                    @can('download-documents')
                    @if($document->files->last())
                    <div class="btn-group" role="group">
                        <a type="button" class="btn btn-outline-secondary" href="/doc_manage/files/preview/{{$document->files->last()->id}}" target="_blank">
                            <i class="bi bi-file-earmark-text"></i></a>
                        <a type="button" class="btn btn-outline-secondary" href="/doc_manage/files/download/{{$document->files->last()->id}}"><i class="bi bi-download"></i></a>
                    </div>
                    @endif
                    @endcan
                    </td>
                    <td> @if (session('editMode')) @include('icons.documents') @endif </td>
                </tr>
            @endforeach
    </tbody>
</table>
</div>
@else
<h4>Документы в данной категории не найдены</h4>
@endif

