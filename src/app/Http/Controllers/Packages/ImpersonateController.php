<?php

namespace App\Http\Controllers\Packages;

use Illuminate\Http\Request;
use Lab404\Impersonate\Controllers\ImpersonateController as BaseImpersonateController;
use Spatie\Permission\Exceptions\UnauthorizedException;

/*
 * as of writing, the entire class is just an extension of the base class,
 * with a slight tweak... a $user->can() check
 * leave() in this case will check against the Impersonated user, instead of the Impersonator
 * it will then throw "UnauthorizedException" (if Route::impersonate() is used instead of this override)
 * so, it has to be overridden to check against the Impersonator
 * all else remain the same
 * */
class ImpersonateController extends BaseImpersonateController
{
    public function take(Request $request, $id, $guardName = null)
    {
        if ($request->user()->can('impersonate')) {
            return parent::take($request, $id, $guardName);
        }

        throw UnauthorizedException::forPermissions([]);
    }

    public function leave()
    {
        $impersonate = app('impersonate');

        if ($impersonate->isImpersonating() && \App\Models\User
                ::find($impersonate->getImpersonatorId())
                ->can('impersonate')
        ) {
            return parent::leave();
        }

        throw UnauthorizedException::forPermissions([]);
    }
}
