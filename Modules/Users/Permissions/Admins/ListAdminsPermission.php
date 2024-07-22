<?php

namespace Modules\Users\Permissions\Admins;

use Modules\Permissions\Interfaces\BasePermission;
use Modules\Permissions\Interfaces\PermissionsGroupInterface;

class ListAdminsPermission extends BasePermission
{
    public function getTranslate(): string
    {
        return __('permissions::permissions.grants.list');
    }

    public function getName(): string
    {
        return $this->getGroup()->getKey() . '.list';
    }

    public function getGroup(): PermissionsGroupInterface
    {
        return app(AdminsManageGroupPermission::class);
    }
}
