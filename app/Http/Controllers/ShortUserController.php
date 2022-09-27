<?php

namespace App\Http\Controllers;

use App\Models\ShortenUrl;

class ShortUserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * get all data related to short urls
     */
    public function index()
    {
        $links = ShortenUrl::join('users', 'users.id', '=', 'shorten_urls.user_id')->get();
        return view('links.index', compact('links'));
    }
}
