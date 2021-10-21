<?php

return [
    'action' => [
        'created' => 'Создание',
        'updated' => 'Редактирование',
        'deleted' => 'Удаление'
    ],
    'models' => [
        'App\Models\Document' => 'Документ',
        'App\Models\Category' => 'Категория',
        'App\Models\Status' => 'Статус',
        'App\Models\Position' => 'Файл',
        'App\Models\Tag' => 'Тэг',
        'App\Models\Role' => 'Роль',
        'App\User' => 'Пользователь'
    ],
    'App\Models\Document' => [
        'category_id' => 'Категория',
        'name' => 'Название',
        'deadline' => 'Дедлайн',
        'completed' => 'Завершен',
        'description' => 'Описание'
    ],
    'App\Models\Category' => [
        'name' => 'Название',
        'category_id' => 'Категория'
    ],
    'App\Models\Status' => [
        'status_id' => 'Статус',
        'name' => 'Название',
        'visible' => 'Видимость'
    ],
    'App\Models\Position' => [
        'document_id' => 'Документ',
        'user_id' => 'Исполнитель',
        'name' => 'Название',
        'file' => 'Файл',
        'deadline' => 'Дедлайн',
        'status_id' => 'Статус',
    ],
    'App\Models\Tag' => [
        'name' => 'Название'
    ],
    'App\Models\Role' => [
        'name' => 'Название',
        'slug' => 'Обозначение'
    ],
    'App\User' => [
        'name' => 'ФИО',
        'email' => 'Email',
        'login' => 'Логин'
    ]
];
