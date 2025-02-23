<?php

namespace Modules\Users\GraphQL\Mutations\BackOffice\Abstract;

use GraphQL\Type\Definition\ResolveInfo;
use Modules\Core\GraphQL\Mutations\BaseMutation;
use Modules\Core\GraphQL\Types\NonNullType;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Models\BaseAuthenticatableUser;
use Rebing\GraphQL\Support\SelectFields;
use Spatie\LaravelData\Data;
use Throwable;

abstract class BaseUserCreateMutation extends BaseMutation
{
    public const NAME = 'baseCreateUser';

    public function __construct(
        protected UserServiceInterface $service,
    )
    {
        $this->setAdminGuard();
    }

    public function args(): array
    {
        return [
            'name' => NonNullType::string(),
            'email' => [
                'type' => NonNullType::string(),
                'rules' => ['email'],
                'description' => 'Email address. Validated with email rule. Should be unique',
            ],
            'password' => [
                'type' => NonNullType::string(),
                'rules' => ['min:8'],
                'description' => 'Password. Validated with min:8 rule',
            ],
        ];
    }

    abstract protected function getDTO(array $args): Data;

    /**
     * @throws Throwable
     */
    public function doResolve(mixed $root, array $args, mixed $context, ResolveInfo $info, SelectFields $fields): BaseAuthenticatableUser
    {
        return $this->service->create(
            $this->getDTO($args)
        );
    }
}
