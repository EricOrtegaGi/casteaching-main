<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\VideosController
 */
class VideoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function users_can_view_videos(): void
    {
        $video = Video::create([
            'title' => 'Ubuntu 101',
            'description' => '# Here description',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at' => Carbon::parse('January 11, 2024 15:00'),
            'previous' => null,
            'next' => null,
            'serie_id' => 1
        ]);

        $response = $this->get('/videos/' . $video->id);

        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here description');
        $response->assertSee('January 11, 2024 15:00');
        $response->assertSee('https://youtu.be/w8j07_DBl_I');


    }

    /**
     * @test
     */
    public function users_cannot_view_not_existing_videos(): void
    {
        $response = $this->get('/videos/999');
        $response->assertStatus(404);
    }

}
