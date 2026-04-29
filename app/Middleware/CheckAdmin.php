<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if ($request->user() && $request->user()->getRole() === User::ROLE_ADMIN) {
            return $next($request);
        }

        return redirect()->route('home.index')
            ->with('error', __('admin.access_denied'));
    }
}
