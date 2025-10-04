<?php 

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiToken
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil token dari header Authorization
        $token = $request->header('Authorization');

        // Check apakah token ada dan format Bearer
        if (!$token || !preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized - Token required. Use format: Bearer your_token'
            ], 401);
        }

        $apiToken = $matches[1];

        // Validasi token dengan database atau hardcoded token
        if (!$this->isValidToken($apiToken)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized - Invalid token'
            ], 401);
        }

        // Token valid, lanjutkan ke function selanjutnya
        return $next($request);
    }

    /**
     * Validasi apakah token valid
     */
    private function isValidToken($token)
    {
        // Opsi 1: Hardcoded token untuk testing (tidak recommended untuk production)
        $validTokens = [
            'zee-web-admin-token-2025',
            'zee-scraper-api-key',
            'brian-yudhistira-token',
            'zee-web-token-1221e821398012'
        ];

        if (in_array($token, $validTokens)) {
            return true;
        }

        // Opsi 2: Validasi dengan database (recommended)
        // Uncomment jika ingin menggunakan database validation
        /*
        $user = User::where('api_token', $token)->first();
        if ($user) {
            // Set user yang terautentikasi
            auth()->setUser($user);
            return true;
        }
        */

        return false;
    }
}