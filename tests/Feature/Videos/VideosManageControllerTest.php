<?php

namespace Tests\Feature\Videos;

use App\Models\Serie;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

/**
 * @covers \App\Http\Controllers\Videos\VideosManageController

 */
class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */

    public function user_with_permissions_can_update_videos(){

        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456'
        ]);

        $response = $this->put('/manage/videos/' . $video->id
            , [
                'title' => 'New Video title',
                'description' => 'New description',
                'url' => 'https://www.youtube.com/watch?v=12345678'
            ]);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status','Successfully updated');

        $newVideo = Video::find($video->id);
        $this->assertEquals('New Video title', $newVideo->title);
        $this->assertEquals('New description', $newVideo->description);
        $this->assertEquals('https://www.youtube.com/watch?v=12345678', $newVideo->url);
        $this->assertEquals($video->id, $newVideo->id);


    }

    /**
     * @test
     */
    public function user_with_permissions_can_see_edit_videos()
    {
        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456'
        ]);

        $response = $this->get('/manage/videos/' . $video->id);

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.edit');
        $response->assertViewHas('video');
        $response->assertSee('<form data-qa="form_video_edit"',false);

        $response->assertSeeText($video->title);
        $response->assertSeeText($video->description);
        $response->assertSee($video->url);

    }

    /**
     * @test
     */

    public function user_with_permissions_can_destroy_videos(){
        $this->loginAsRegularUser();

        $video = Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456'
        ]);

        $response = $this->delete('/manage/videos/' . $video->id);

        $response->assertStatus(403);
    }

    /**
     * @test
     */

    public function user_without_permissions_cannot_destroy_videos(){
        $this->loginAsVideoManager();

        $video = Video::create([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456'
        ]);

        $response = $this->delete('/manage/videos/' . $video->id);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status','Successfully deleted');

        $this->assertNull(Video::find($video->id));
        $this->assertNull($video->fresh());
    }

    /**
     * @test
     */

    public function user_with_permissions_can_store_videos()
    {
        $this->loginAsVideoManager();

        $video = objectify([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456'
        ]);

        $response = $this->post('/manage/videos', [
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456'
        ]);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status','Successfully created');

        $videoDB = Video::first();

        $this->assertNotNull($videoDB);
        $this->assertEquals($videoDB->title,$video->title);
        $this->assertEquals($videoDB->description, $video->description);
        $this->assertEquals($videoDB->url, $video->url);
        $this->assertNull($video->published_at);
    }

    /**
     * @test
     */

    public function user_with_permissions_can_store_videos_with_serie()
    {
        $this->loginAsVideoManager();

        $serie = Serie::create([
            'title' => 'TDD (Test Driven Development)',
            'description' => 'Bla bla bla',
            'image' => 'tdd.png',
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/' . md5('sergiturbadenas@gmail.com'),
        ]);

        $video = objectify([
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456',
            'serie_id' => $serie->id
        ]);

        $response = $this->post('/manage/videos', [
            'title' => 'Video title',
            'description' => 'Video description',
            'url' => 'https://www.youtube.com/watch?v=123456',
            'serie_id' => $serie->id
        ]);

        $response->assertRedirect(route('manage.videos'));
        $response->assertSessionHas('status','Successfully created');

        $videoDB = Video::first();

        $this->assertNotNull($videoDB);
        $this->assertEquals($videoDB->title,$video->title);
        $this->assertEquals($videoDB->description, $video->description);
        $this->assertEquals($videoDB->url, $video->url);
        $this->assertEquals($videoDB->serie_id, $video->serie_id);
        $this->assertNull($video->published_at);
    }

    /**
     * @test
     */

    public function user_with_permissions_can_see_add_videos()
    {
        $this->loginAsVideoManager();
        $response = $this->get('/manage/videos');
        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');

        $response->assertSee('<form data-qa="form_video_create"',false);
    }

    /**
     * @test
     */

    public function user_without_videos_manage_create_cannot_see_add_videos()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
        $user = User::create([
            'name' => 'Sergi Tur Badenas',
            'email' => 'sergitur@casteaching.com',
            'password' => Hash::make('12345678'),
        ]);
        $user->givePermissionTo('videos_manage_index');
        add_personal_team($user);

        Auth::login($user);

        $response = $this->get('/manage/videos');
        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
        $response->assertDontSee('<form data-qa="form_video_create"',false);
    }

    /**
     * @test
     */

    public function user_with_permissions_can_manage_videos(): void
    {
        $this->loginAsVideoManager();

        $videos = create_sample_videos();

        $response = $this->get('/manage/videos');
        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
        $response->assertViewHas('videos',function($videos){
            return $videos->count() === count($videos) && get_class($videos) === Collection::class &&
                get_class($videos[0]) === Video::class;
        });

        foreach ($videos as $video) {
            $response->assertSee($video->id);
            $response->assertSee($video->title);
        }

    }

    /**
     * @test
     */

    public function regular_users_cannot_manage_videos()
    {
        $this->loginAsRegularUser();
        $response = $this->get('/manage/videos');
        $response->assertStatus(403);
    }

    /**
     * @test
     */

    public function guest_users_cannot_manage_videos()
    {
        $response = $this->get('/manage/videos');
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */

    public function superadmins_can_manage_videos(): void
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/manage/videos');

        $response->assertStatus(200);
        $response->assertViewIs('videos.manage.index');
    }

    private function loginAsVideoManager()
    {
        Auth::login(create_video_manager_user());
    }

    private function loginAsSuperAdmin()
    {
        Auth::login(create_superadmin_user());
    }

    private function loginAsRegularUser()
    {
        Auth::login(create_regular_user());
    }
}
