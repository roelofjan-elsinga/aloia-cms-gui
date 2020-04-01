<?php


namespace AloiaCms\GUI\Tests\Controllers;

use AloiaCms\GUI\Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->authenticateRequest();
    }

    public function testUserCanViewArticleOverview()
    {
        $this->withoutExceptionHandling();

        $this
            ->get(route('articles.index'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::articles.index');
    }

    public function testUserCanViewArticleCreationPage()
    {
        $this->withoutExceptionHandling();

        $this
            ->get(route('articles.create'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::articles.create');
    }
}
