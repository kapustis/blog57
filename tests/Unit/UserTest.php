<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_fetch_their_most_recent_comment()
    {
        $user = create('App\Models\User');
        $comment = create('App\Models\BlogComment', ['user_id' => $user->id]);
        $this->assertEquals($comment->id, $user->lastComment->id);
    }
}
