<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function guest_and_subscriber_cannot_create_post(){
        $this->withExceptionHandling();

        //guest cannot
        $response = $this->post(route('admin.posts.store'));
        $response->assertStatus(302)->assertRedirect(route('login'));
        

        //subscriber cannot
        $this->signIn();
        $response = $this->post(route('admin.posts.store'));
        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_create_posts_as_draft(){
        $this->signInAdmin();

        $response = $this->post(route('admin.posts.store'), [
            'title' => 'Some title',
            'body' => 'Some body',
        ]);

        $post = (new \App\Post)->first();
        $this->assertEquals('Some title', $post->title);
        $this->assertEquals('Some body', $post->body);
        $this->assertEquals('draft', $post->status);

        
        $this->get($response->headers->get('Location'))
            ->assertSee('Some title')
            ->assertSee('Some body');
        
    }

    /** @test */
    public function title_and_body_are_required(){
        $this->withExceptionHandling();
        $this->signInAdmin();

        $response = $this->post(route('admin.posts.store'), [
            'title' => 'Some title',
        ]);

        $response->assertSessionHasErrors(['body']);

        $response = $this->post(route('admin.posts.store'), [
            'body' => 'Some body',
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function guest_and_subscriber_cannot_publish_post(){
        $this->withExceptionHandling();

        //guest cannot
        $response = $this->post(route('admin.posts.publish'));
        $response->assertStatus(302)->assertRedirect(route('login'));
        

        //subscriber cannot
        $this->signIn();
        $response = $this->post(route('admin.posts.publish'));
        $response->assertStatus(403);
    }

    /** @test */
    public function admin_can_publish_a_post(){
        $this->signInAdmin();
        $post = create(\App\Post::class, ['user_id' => auth()->id()]);
        $this->post(route('admin.posts.publish'), [
            'post_id' => $post->id,
        ]);

        $this->assertEquals('published', $post->fresh()->status);

    }
}
