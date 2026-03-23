<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $shortCode)
    {
        $shortCode = strtolower($shortCode);
        $url = Url::where('short_code', $shortCode)->firstOrFail();

        if ($url->expires_at && $url->expires_at->isPast()) {
//            return apiResponse(null, 'The link has expired', 410);
            abort(410);
        }

        $url->increment('clicks');

        return redirect()->away($url->original_url);
    }
}
