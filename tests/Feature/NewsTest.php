<?php
namespace Tests\Feature;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class NewsTest extends TestCase {
    use RefreshDatabase;
    protected function setUp(): void { parent::setUp();$this->seed(); }
    public function test_home_displays_seeded_news(): void { $this->get('/')->assertOk()->assertSee('The business edition')->assertSee('Lulu Retail plans Philippine expansion, franchise opportunities and bond offering'); }
    public function test_search_filters_results(): void { $this->get('/?q=Lulu+Retail')->assertOk()->assertSee('Lulu Retail plans Philippine expansion, franchise opportunities and bond offering')->assertDontSee('Little faces, big smiles'); }
    public function test_categories_filter_results(): void { $this->get('/?category=Banking')->assertOk()->assertSee('Banking')->assertDontSee('BIR issues electronic invoicing guidelines'); }
    public function test_pagination_and_missing_article(): void { $this->get('/?page=2')->assertOk()->assertSee('Page 2');$this->get('/articles/does-not-exist')->assertNotFound(); }
    public function test_article_uses_original_source(): void { $article=Article::where('source_url','!=','')->first();$this->get('/articles/'.$article->slug)->assertOk()->assertSee($article->title)->assertSee($article->source_url); }
    public function test_empty_search_and_input_validation(): void { $this->get('/?q=zzzznomatch')->assertOk()->assertSee('No stories found');$this->getJson('/?page=-1')->assertUnprocessable(); }
    public function test_seeding_is_idempotent(): void { $count=Article::count();$this->seed();$this->assertSame($count,Article::count()); }
}
