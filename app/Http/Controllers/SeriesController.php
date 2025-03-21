<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function show($id)
    {
        $series = Serie::findOrFail($id);
        $video = $series->videos->first();
        $iframe = $video ? $this->generateYouTubeIframe($video->url) : null;

        return view('series.show', compact('series', 'video', 'iframe'));
    }

    public function showVideo($seriesId, $videoId)
    {
        $series = Serie::findOrFail($seriesId);
        $video = $series->videos()->findOrFail($videoId);
        $iframe = $this->generateYouTubeIframe($video->url);

        return view('series.show', compact('series', 'video', 'iframe'));
    }

    private function generateYouTubeIframe($url)
    {
        preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
        $id = $matches[1] ?? null;

        if ($id) {
            return '<iframe width="895" height="600" src="https://www.youtube.com/embed/' . $id . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
        }

        return null;
    }
}
