<?php
    namespace App\Type;

    use App\DB;
    use App\Types;
    use GraphQL\Type\Definition\ObjectType;

    class QueryType extends ObjectType
    {
        public function __construct()
        {
            $config = [
                'fields' => function() {
                    return [
                        'user' => [
                            'type' => Types::user(),
                            'description' => 'Возвращает ползьзователя id',
                            'args' => [
                                'id' => Types::int()
                            ],
                            'resolve' => function ($root, $args) {
                                return DB::selectOne("SELECT * FROM users WHERE id = {$args['id']}");
                            }
                        ],
                        'allUsers' => [
                            'type' => Types::listOf(Types::user()),
                            'description' => 'Список пользователей',
                            'resolve' => function() {
                                return DB::select('SELECT * FROM users');
                            }
                        ]
                    ];
                }
            ];
            parent::__construct($config);
        }
    }
?>