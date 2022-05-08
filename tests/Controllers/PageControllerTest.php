<?php


namespace FlatFileCms\GUI\Tests\Controllers;

use AloiaCms\GUI\Tests\TestCase;
use AloiaCms\Models\Page;

class PageControllerTest extends TestCase
{
    public function testUserCanViewPageOverview()
    {
        $this
            ->get(route('pages.index'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::pages.index');
    }

    public function testUserCanSearchArticlesInOverview()
    {
        $page = Page::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Testing page',
                'description' => 'Description',
                'is_published' => false,
                'is_scheduled' => false,
                'summary' => 'Summary',
                'template_name' => 'default',
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        Page::find('test-post')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Test post',
                'description' => 'Description',
                'is_published' => false,
                'is_scheduled' => false,
                'summary' => 'Summary',
                'template_name' => 'default',
            ])
            ->setBody('# This is a test post')
            ->setPostDate(now())
            ->save();

        $this
            ->get(route('pages.index', ['q' => 'testing']))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::pages.index')
            ->assertSee('Testing page')
            ->assertDontSee('Test post');
    }

    public function testUserCanViewPageCreationPage()
    {
        $this
            ->get(route('pages.create'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::pages.create');
    }

    public function testUserCanCreateAnPage()
    {
        $this
            ->post(route('pages.store'), [
                'url' => 'testing',
                'title' => 'Testing',
                'description' => 'Description',
                'post_date' => date('Y-m-d'),
                'is_published' => false,
                'is_scheduled' => false,
                'summary' => 'Summary',
                'template_name' => 'default',
                'content' => '# Testing',
                'file_type' => 'md'
            ])
            ->assertRedirect(route('pages.index'))
            ->assertSessionHas('created_page', true);

        $this->assertTrue(Page::find('testing')->exists());
    }

    public function testUserCanViewEditPage()
    {
        Page::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Testing',
                'description' => 'Description',
                'post_date' => date('Y-m-d'),
                'is_published' => false,
                'is_scheduled' => false,
                'summary' => 'Summary',
                'template_name' => 'default',
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->get(route('pages.edit', 'testing'))
            ->assertOk()
            ->assertViewIs('aloiacmsgui::pages.edit');
    }

    public function testUserCanUpdatePage()
    {
        Page::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Testing',
                'description' => 'Description',
                'post_date' => date('Y-m-d'),
                'is_published' => false,
                'is_scheduled' => false,
                'summary' => 'Summary',
                'template_name' => 'default',
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->put(route('pages.update', 'testing'), [
                'url' => 'testing-1',
                'original_url' => 'testing',
                'title' => 'Testing',
                'description' => 'Description',
                'post_date' => date('Y-m-d'),
                'is_published' => false,
                'is_scheduled' => false,
                'summary' => 'Summary',
                'template_name' => 'default',
                'content' => '# Testing',
                'file_type' => 'md'
            ])
            ->assertRedirect(route('pages.index'))
            ->assertSessionHas('updated_page', true);

        $this->assertFalse(Page::find('testing')->exists());
        $this->assertTrue(Page::find('testing-1')->exists());
    }

    public function testUserCanDeletedPage()
    {
        Page::find('testing')
            ->setExtension('md')
            ->setMatter([
                'title' => 'Testing',
                'description' => 'Description',
                'post_date' => date('Y-m-d'),
                'is_published' => false,
                'is_scheduled' => false,
                'summary' => 'Summary',
                'template_name' => 'default',
            ])
            ->setBody('# Testing')
            ->setPostDate(now())
            ->save();

        $this
            ->delete(route('pages.destroy', 'testing'))
            ->assertRedirect(route('pages.index'))
            ->assertSessionHas('deleted_page', true);

        $this->assertFalse(Page::find('testing')->exists());
    }
}
