<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function show($id)
    {
        $video = Video::findOrFail($id);
        $iframe = $this->generateYouTubeIframe($video->url);

        return view('videos.show', compact('video', 'iframe'));
    }

    private function generateYouTubeIframe($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        $id = $matches[1] ?? null;

        if ($id) {
            return '<iframe width="100%" height="auto" style="aspect-ratio: 16/9;" src="https://www.youtube.com/embed/' . $id . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
        }

        return null;
    }

}
