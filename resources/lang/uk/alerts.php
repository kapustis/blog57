<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Мовні ресурси виведення сповіщень
    |--------------------------------------------------------------------------
    |
    | Наступні мовні ресурси використовуються для виведення
    | повідомлень в різних сценаріях CRUD.
    | Ви можете вільно змінювати ці мовні ресурси відповідно до вимог
    | вашої програми.
    |
    */

    'backend' => [
        'channels' => [
            'created' => 'Категорія була успішно створена.',
            'deleted' => 'Категорія була успішно вилучена.',
            'updated' => 'Категорія була успішно оновлена.',
        ],
        'users' => [
            'confirmed' => 'Користувач успішно підтверджений.',
            'created' => 'Користувач був успішно створений.',
            'deleted' => 'Користувача успішно вилучено.',
            'deleted_permanently' => 'Користувач був стертий назавжди.',
            'restored' => 'Користувача успішно відновлено.',
            'session_cleared' => 'Сесія користувача була успішно очищена.',
            'social_deleted' => 'Соціальний обліковий запис успішно вилучено',
            'unconfirmed' => 'Користувач змінений на статус не підтверджений',
            'updated' => 'Параметри користувача успішно оновлені.',
            'updated_password' => 'Пароль користувача був успішно оновлений.',
        ],
    ],
    'frontend' => [
        'contact' => [
            'sent' => 'Дякуємо! Ваша інформація прийнята і буде оброблена найближчим часом.',
        ],
    ],

];