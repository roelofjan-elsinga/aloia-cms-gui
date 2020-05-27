<?php


namespace AloiaCms\GUI\Tests\Controllers;

use AloiaCms\GUI\Tests\TestCase;
use AloiaCms\Models\Article;

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

    public function testUserCanCreateAnArticle()
    {
        $this->withoutExceptionHandling();

        $this
            ->post(route('articles.store'), [
                'slug' => 'testing',
                'file_type' => 'md',
                'content' => '# Testing',
                'description' => 'This is a test',
                'post_date' => now()->toDateString(),
                'is_published' => "0",
                'is_scheduled' => "0",
                'faq' => "[]"
            ])
            ->assertRedirect(route('articles.index'))
            ->assertSessionHas('created_article', true);

        $this->assertTrue(Article::find('testing')->exists());
    }

    public function testUserCanViewEditPage()
    {
        $this->withoutExceptionHandling();

        Article::find('testing')
            ->setExtension('md')
            ->setMatter([
                'description' => 'This is a test'
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->get(route('articles.edit', 'testing'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::articles.edit');
    }

    public function testUserCanUpdateArticle()
    {
        $this->withoutExceptionHandling();

        Article::find('testing')
            ->setExtension('md')
            ->setMatter([
                'description' => 'This is a test'
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->put(route('articles.update', 'testing'), [
                'file_type' => 'md',
                'original_slug' => 'testing',
                'slug' => 'testing-1',
                'content' => '# Testing stuff',
                'description' => 'This is a test',
                'post_date' => now()->toDateString(),
                'is_published' => "0",
                'is_scheduled' => "0",
                'faq' => json_encode([
                    [
                        'question' => 'Is this a test?',
                        'answer' => 'Yes, this is a test'
                    ]
                ])
            ])
            ->assertRedirect(route('articles.index'))
            ->assertSessionHas('updated_article', true);

        $this->assertFalse(Article::find('testing')->exists());
        $this->assertTrue(Article::find('testing-1')->exists());
        $this->assertCount(1, Article::find('testing-1')->faq);
    }

    public function testUserCanDeletedArticle()
    {
        $this->withoutExceptionHandling();

        Article::find('testing')
            ->setExtension('md')
            ->setMatter([
                'description' => 'This is a test'
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->delete(route('articles.destroy', 'testing'))
            ->assertRedirect(route('articles.index'))
            ->assertSessionHas('deleted_article', true);

        $this->assertFalse(Article::find('testing')->exists());
    }
}
