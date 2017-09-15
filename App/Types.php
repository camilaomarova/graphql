<?php
namespace App;
use App\Type\QueryType;
use App\Type\MutationType;
use App\Type\UserType;
use App\Type\InputUserType;
use GraphQL\Type\Definition\Type;
use App\Type\Scalar\EmailType;

/**
 * Class Types
 *
 * Реестр и фабрика типов для GraphQL
 *
 * @package App
 */
class Types
{
    /**
     * @var QueryType
     */
    private static $query;
    /**
     * @var UserType
     */
    private static $mutation;
    /**
     * @var UserType
     */
    private static $user;
    /**
     * @var InputUserType
     */
    private static $inputUser;
    /**
     * @var EmailType
     */
    private static $emailType;
    /**
     * @return QueryType
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }
    /**
     * @return UserType
     */
    public static function user()
    {
        return self::$user ?: (self::$user = new UserType());
    }

    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new MutationType());
    }
    /**
     * @return \GraphQL\Type\Definition\IntType
     */
    public static function int()
    {
        return Type::int();
    }
    /**
     * @return \GraphQL\Type\Definition\StringType
     */
    public static function string()
    {
        return Type::string();
    }
    /**
     * @param \GraphQL\Type\Definition\Type $type
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public static function listOf($type)
    {
        return Type::listOf($type);
    }

    public static function inputUser()
    {
        return self::$inputUser ?: (self::$inputUser = new InputUserType());
    }

    public static function nonNull($type)
    {
        return Type::nonNull($type);
    }

    public static function email()
    {
        return self::$emailType ?: (self::$emailType = new EmailType());
    }
}