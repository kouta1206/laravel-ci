<?php

namespace Tests\Feature;
use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    // AAA(arrange-act-assert)を意識してテストを書く
    // 準備・実行・検証
    use RefreshDatabase;

    public function testIsLikedByNull()
    {
        //　arrange
        $article = factory(Article::class)->create();

        // act
        $result = $article->isLikedBy(null);

        // assert
        $this->assertFalse($result);
    }

    public function testIsLikedByTheUser()
    {
        //arrange
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $article->likes()->attach($user);

        // act
        $result = $article->isLikedBy($user);

        // assert
        $this->assertTrue($result);
    }

    public function testIsLikedByAnother()
    {
        // arrange
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        $article->likes()->attach($another);

        // act
        $result = $article->isLikedBy($user);

        // assert
        $this->assertFalse($result);
    }

}
