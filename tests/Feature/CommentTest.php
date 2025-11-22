<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_comment_to_published_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);

        $response = $this->actingAs($user)
            ->post(route('comments.store', $post), [
                'content' => 'This is a test comment.',
            ]);

        $response->assertRedirect(route('posts.show', $post));
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content' => 'This is a test comment.',
        ]);
    }

    public function test_guest_cannot_add_comment(): void
    {
        $post = Post::factory()->create(['status' => 'published']);

        $response = $this->post(route('comments.store', $post), [
            'content' => 'This is a test comment.',
        ]);

        $response->assertRedirect('login');
        $this->assertDatabaseCount('comments', 0);
    }

    public function test_comment_content_is_required(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);

        $response = $this->actingAs($user)
            ->post(route('comments.store', $post), []);

        $response->assertSessionHasErrors('content');
        $this->assertDatabaseCount('comments', 0);
    }

    public function test_user_can_edit_own_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
            'content' => 'Original comment',
        ]);

        $response = $this->actingAs($user)
            ->put(route('comments.update', $comment), [
                'content' => 'Updated comment',
            ]);

        $response->assertRedirect(route('posts.show', $post));
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'content' => 'Updated comment',
        ]);
    }

    public function test_user_cannot_edit_others_comment(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);
        $comment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($user)
            ->get(route('comments.edit', $comment));

        $response->assertForbidden();
    }

    public function test_admin_can_edit_any_comment(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($admin)
            ->get(route('comments.edit', $comment));

        $response->assertOk();
    }

    public function test_user_can_delete_own_comment(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('comments.destroy', $comment));

        $response->assertRedirect(route('posts.show', $post));
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    public function test_user_cannot_delete_others_comment(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);
        $comment = Comment::factory()->create([
            'user_id' => $otherUser->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($user)
            ->delete(route('comments.destroy', $comment));

        $response->assertForbidden();
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
    }

    public function test_admin_can_delete_any_comment(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $post = Post::factory()->create(['status' => 'published']);
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $response = $this->actingAs($admin)
            ->delete(route('comments.destroy', $comment));

        $response->assertRedirect(route('posts.show', $post));
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }
}
