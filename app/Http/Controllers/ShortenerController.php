<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortRequest;
use App\Models\ShortenUrl;

class ShortenerController extends Controller
{
    /**
     * @param ShortRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shortenUrl(ShortRequest $request)
    {
        if ($request->original_url) {
            if (auth()->user()) {   // create short url related to given url with user id
                $url = auth()->user()->links()->create([
                    'original_url' => $request->original_url
                ]);
            }
        }
        if ($url) {
            $short_url = base_convert($url->id, 10, 36); //convert 10 to 36
            $url->update([
                'short_url' => $short_url
            ]);
            return redirect()->back()->with('message', 'Short Url is:' . '<a style="color:green" href="' . url($short_url) . '">' . url($short_url) . '</a>');
        }
        return back();
    }

    /**
     * @param $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($key)
    {
        //show generated short url
        $shortUrl = ShortenUrl::where('short_url', $key)->first();
        if ($shortUrl) {
            return redirect()->to(url($shortUrl->original_url));
        }
        return redirect()->to(url('/'));
    }
}
