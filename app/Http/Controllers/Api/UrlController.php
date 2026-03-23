<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreUrlRequest;
use App\Http\Requests\Api\UpdateUrlRequest;
use App\Http\Resources\Api\UrlResource;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Url::class, 'url');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $urls = $request->user()->urls()->latest()->paginate(10);

//        return apiResponse(UrlResource::collection($urls));
        return UrlResource::collection($urls);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $url = $request->user()->urls()->create([
            'original_url' => $request->original_url,
            'short_code' => $this->generateUniqueShortCode(),
            'expires_at' => $request->expires_at,
        ]);

        return apiResponse(
            new UrlResource($url),
            'Short URL created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Url $url)
    {
        return apiResponse(new UrlResource($url));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        $url->update($request->only('original_url', 'expires_at'));

        return apiResponse(
            new UrlResource($url->fresh()),
            'URL updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        $url->delete();

        return response()->noContent();
    }

    private function generateUniqueShortCode(): string
    {
        do {
            $timestamp = base_convert(now()->timestamp, 10, 36);
            $random = Str::random(3);
            $code = $timestamp . $random;
            $code = strtolower($code);
        } while (Url::where('short_code', $code)->exists());

        return $code;
    }
}
