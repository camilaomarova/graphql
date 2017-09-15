<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\DB;
use App\Types;
use GraphQL\GraphQL;
use GraphQL\Schema;

try {
    // Настройки подключения к БД
    $config = [
        'host' => 'localhost',
        'database' => 'graphql',
        'username' => 'root',
        'password' => '1234567'
    ];

    // Инициализация соединения с БД
    DB::init($config);

    // Получение запроса
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);
    $query = $input['query'];

    // Получение переменных запроса
    $variables = isset($input['variables']) ? json_decode($input['variables'], true) : null;

    // Создание схемы
    $schema = new Schema([
        'query' => Types::query(),
        'mutation' => Types::mutation()
    ]);

    // Выполнение запроса
    $result = GraphQL::execute($schema, $query, null, null, $variables);
} catch (\Exception $e) {
    $result = [
        'error' => [
            'message' => $e->getMessage()
        ]
    ];
}

// Вывод результата
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($result);