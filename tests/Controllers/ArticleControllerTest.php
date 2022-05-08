<?php


namespace AloiaCms\GUI\Tests\Controllers;

use AloiaCms\GUI\Tests\TestCase;
use AloiaCms\Models\Article;

class ArticleControllerTest extends TestCase
{
    public function testUserCanViewArticleOverview()
    {
        $this
            ->get(route('articles.index'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::articles.index');
    }

    public function testUserCanSearchArticlesInOverview()
    {
        Article::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'This is a test',
                'description' => 'This is a testing post'
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        Article::find('test-post')
            ->setExtension('md')
            ->setMatter([
                'title' => 'This is another test',
                'description' => 'This is a test post'
            ])
            ->setBody('# Test post')
            ->setPostDate(now())
            ->save();

        $this
            ->get(route('articles.index', ['q' => 'testing']))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::articles.index')
            ->assertSee('This is a test')
            ->assertDontSee('This is another test');
    }

    public function testUserCanViewArticleCreationPage()
    {
        $this
            ->get(route('articles.create'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::articles.create');
    }

    public function testUserCanCreateAnArticle()
    {
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
