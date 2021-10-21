@if (isset($logs) && $logs->count())
<hr>
<div class="table-responsive">
<table class="table">

    <thead>
        <tr>
            <th scope="col">Действие</th>
            <th scope="col">Модель</th>
            <th scope="col">ID</th>
            <th scope="col">Пользователь</th>
            <th scope="col">Дата и время</th>
            <th scope="col">Подробности</th>
        </tr>
    </thead>
    <tbody>
            @foreach ($logs as $log)
                <tr>
                    <td>{{ __('logs.action.' . $log->description) }}</td>
                    <td>{{ __('logs.models.' . $log->subject_type) }}</td>
                    <td>{{ $log->subject_id }}</td>
                    <td>{{ $users->find($log->causer_id)->name; }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>
                        @if($log->properties->count())
                            @foreach ($log->properties['attributes'] as $properti => $value)
                                {{ __('logs.' . $log->subject_type . '.' . $properti) .' : ' }}
                                @if (isset($log->properties['old'])) {{$log->properties['old'][$properti]}} -> @endif
                                {{ $value }}
                                <br>
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
    </tbody>
</table>
{{ $logs->links() }}
</div>
@else
<h4>Логи не найдены</h4>
@endif
