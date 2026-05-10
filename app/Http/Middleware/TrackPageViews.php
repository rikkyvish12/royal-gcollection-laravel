<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip admin routes and API routes
        if ($request->is('admin/*') || $request->is('api/*') || $request->is('livewire/*')) {
            return $next($request);
        }

        $response = $next($request);

        // Don't track in console
        if (app()->runningInConsole()) {
            return $response;
        }

        try {
            $sessionId = $request->session()->get('analytics_session_id');
            
            if (!$sessionId) {
                $sessionId = uniqid('session_', true);
                $request->session()->put('analytics_session_id', $sessionId);
            }

            $ipAddress = $request->ip();
            $userAgent = $request->userAgent();
            
            // Find or create visitor
            $visitor = Visitor::where('session_id', $sessionId)->first();
            
            if (!$visitor) {
                $deviceType = $this->detectDeviceType($userAgent);
                $browser = $this->detectBrowser($userAgent);
                $os = $this->detectOS($userAgent);
                $referrer = $request->headers->get('referer');
                $referrerDomain = $referrer ? parse_url($referrer, PHP_URL_HOST) : null;

                $visitor = Visitor::create([
                    'session_id' => $sessionId,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'device_type' => $deviceType,
                    'browser' => $browser,
                    'os' => $os,
                    'referrer' => $referrer,
                    'referrer_domain' => $referrerDomain,
                    'first_visit' => now(),
                    'last_visit' => now(),
                    'page_views' => 1,
                ]);
            } else {
                $visitor->update([
                    'last_visit' => now(),
                    'page_views' => $visitor->page_views + 1,
                ]);
            }

            // Record page view
            PageView::create([
                'visitor_id' => $visitor->id,
                'url' => $request->fullUrl(),
                'title' => null, // Will be set by JS if needed
                'referrer' => $request->headers->get('referer'),
                'viewed_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the request
            \Log::error('Analytics tracking error: ' . $e->getMessage());
        }

        return $response;
    }

    private function detectDeviceType(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'unknown';
        }

        $userAgent = strtolower($userAgent);

        if (preg_match('/mobile|android|iphone|ipad|ipod|blackberry|windows phone/i', $userAgent)) {
            if (preg_match('/ipad|tablet/i', $userAgent)) {
                return 'tablet';
            }
            return 'mobile';
        }

        return 'desktop';
    }

    private function detectBrowser(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'unknown';
        }

        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'chrome') !== false && strpos($userAgent, 'edge') === false) {
            return 'Chrome';
        } elseif (strpos($userAgent, 'safari') !== false && strpos($userAgent, 'chrome') === false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'firefox') !== false) {
            return 'Firefox';
        } elseif (strpos($userAgent, 'edge') !== false) {
            return 'Edge';
        } elseif (strpos($userAgent, 'opera') !== false || strpos($userAgent, 'opr') !== false) {
            return 'Opera';
        }

        return 'Other';
    }

    private function detectOS(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'unknown';
        }

        $userAgent = strtolower($userAgent);

        if (strpos($userAgent, 'windows') !== false) {
            return 'Windows';
        } elseif (strpos($userAgent, 'macintosh') !== false || strpos($userAgent, 'mac os') !== false) {
            return 'macOS';
        } elseif (strpos($userAgent, 'linux') !== false) {
            return 'Linux';
        } elseif (strpos($userAgent, 'android') !== false) {
            return 'Android';
        } elseif (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ipad') !== false) {
            return 'iOS';
        }

        return 'Other';
    }
}
