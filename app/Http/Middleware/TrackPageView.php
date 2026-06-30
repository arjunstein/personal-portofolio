<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            PageView::create([
                'ip_address' => $request->ip(),
                'path'       => $request->path(),
                'user_agent' => $request->userAgent(),
                'created_at' => now(),
            ]);
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (!$response->isSuccessful()) {
            return false;
        }

        if (!$request->isMethod('GET')) {
            return false;
        }

        $ua = strtolower($request->userAgent() ?? '');
        $bots = ['bot', 'crawler', 'spider', 'slurp', 'facebookexternalhit', 'curl', 'wget'];
        foreach ($bots as $bot) {
            if (str_contains($ua, $bot)) {
                return false;
            }
        }

        return true;
    }
}
