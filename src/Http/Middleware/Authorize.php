<?php

namespace Spatie\WebTinker\Http\Middleware;

use Illuminate\Support\Facades\Gate;

class Authorize
{
    public function handle($request, $next)
    {
        return $this->allowedToUseTinker($request->user())
            ? $next($request)
            : abort(403);
    }

    protected function allowedToUseTinker($user): bool
    {
        if (! config('web-tinker.enabled')) {
            return false;
        }

        return Gate::check('viewWebTinker', $user);
    }
}
