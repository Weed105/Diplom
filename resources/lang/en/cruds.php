<?php

return [
    'userManagement' => [
        'title'          => 'Управление пользователями',
        'title_singular' => 'Управление пользователями',
    ],
    'permission'     => [
        'title'          => 'Разрешения',
        'title_singular' => 'Разрешение',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Название',
            'title_helper'      => '',
            'created_at'        => 'Создано в',
            'created_at_helper' => '',
            'updated_at'        => 'Обновлено в',
            'updated_at_helper' => '',
            'deleted_at'        => 'Удалено в',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Роли',
        'title_singular' => 'Роль',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Название',
            'title_helper'       => '',
            'permissions'        => 'Разрешения',
            'permissions_helper' => '',
            'created_at'         => 'Создано в',
            'created_at_helper'  => '',
            'updated_at'         => 'Обновлено в',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Удалено в',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Пользователи',
        'title_singular' => 'Пользователь',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Имя',
            'name_helper'              => '',
            'email'                    => 'Электронная почта',
            'email_helper'             => '',
            'email_verified_at'        => 'Почта подтверждена в',
            'email_verified_at_helper' => '',
            'password'                 => 'Пароль',
            'password_helper'          => '',
            'roles'                    => 'Роли',
            'roles_helper'             => '',
            'remember_token'           => 'Запоминающий токен',
            'remember_token_helper'    => '',
            'created_at'               => 'Создано в',
            'created_at_helper'        => '',
            'updated_at'               => 'Обновлено в',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Удалено в',
            'deleted_at_helper'        => '',
            'institution'              => 'Учреждение',
            'institution_helper'       => '',
        ],
    ],
    'discipline'     => [
        'title'          => 'Дисциплины',
        'title_singular' => 'Дисциплина',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Имя',
            'name_helper'       => '',
            'created_at'        => 'Создано в',
            'created_at_helper' => '',
            'updated_at'        => 'Обновлено в',
            'updated_at_helper' => '',
            'deleted_at'        => 'Удалено в',
            'deleted_at_helper' => '',
        ],
    ],
    'institution'    => [
        'title'          => 'Учреждения',
        'title_singular' => 'Учреждение',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Имя',
            'name_helper'        => '',
            'description'        => 'Описание',
            'description_helper' => '',
            'logo'               => 'Логотип',
            'logo_helper'        => '',
            'created_at'         => 'Создано в',
            'created_at_helper'  => '',
            'updated_at'         => 'Обновлено в',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Удалено в',
            'deleted_at_helper'  => '',
        ],
    ],
    'course'         => [
        'title'          => 'Курсы',
        'title_singular' => 'Курс',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'               => 'Имя',
            'name_helper'        => '',
            'description'        => 'Описание',
            'description_helper' => '',
            'photo'              => 'Фото',
            'photo_helper'       => '',
            'institution'        => 'Учреждение',
            'institution_helper' => '',
            'price'              => 'Цена',
            'price_helper'       => '',
            'disciplines'        => 'Дисциплины',
            'disciplines_helper' => '',
            'created_at'         => 'Создано в',
            'created_at_helper'  => '',
            'updated_at'         => 'Обновлено в',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Удалено в',
            'deleted_at_helper'  => '',
        ],
    ],
    'enrollment'     => [
        'title'          => 'Заявки',
        'title_singular' => 'Заявка',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'user'              => 'Пользователь',
            'user_helper'       => '',
            'course'            => 'Курс',
            'course_helper'     => '',
            'status'            => 'Статус',
            'status_helper'     => '',
            'created_at'        => 'Создано в',
            'created_at_helper' => '',
            'updated_at'        => 'Обновлено в',
            'updated_at_helper' => '',
            'deleted_at'        => 'Удалено в',
            'deleted_at_helper' => '',
        ],
    ],
];
