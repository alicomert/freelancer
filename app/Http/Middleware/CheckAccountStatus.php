<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if account is banned (status 2)
            if ($user->account_status == 2) {
                $bannedDate = $user->banned_at ? $user->banned_at->format('d.m.Y H:i') : 'Bilinmeyen tarih';
                $banMessage = "Hesabınız {$bannedDate} tarihinde banlandı.";
                
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('login')->with('banned_message', $banMessage);
            }
            
            // Check if account is at risk (status 1) - only allow viewing, no updates
            if ($user->account_status == 1) {
                // Allow only GET requests and logout
                if (!$request->isMethod('GET') && !$request->is('logout')) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Hesabınız risk altında. Sadece görüntüleme yapabilirsiniz.'
                        ], 403);
                    }
                    
                    return redirect()->back()->with('error', 
                        'Hesabınız risk altında. Sadece görüntüleme yapabilirsiniz.'
                    );
                }
            }
            
            // Check if current session is blocked (remote logout)
            $sessionId = $request->session()->getId();
            $sessionBlocked = DB::table('sessions')
                ->where('id', $sessionId)
                ->where('is_blocked', true)
                ->exists();
                
            if ($sessionBlocked) {
                // Delete the blocked session
                DB::table('sessions')->where('id', $sessionId)->delete();
                
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('login')->with('info', 
                    'Güvenlik nedeniyle oturumunuz sonlandırılmıştır. Lütfen tekrar giriş yapın.'
                );
            }
        }
        
        return $next($request);
    }
}