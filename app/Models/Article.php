<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Article extends Model {
    protected $fillable = ['slug','title','excerpt','author','category','image','source_url','published_at','body'];
    protected function casts(): array { return ['published_at'=>'datetime','body'=>'array']; }
    public function getRouteKeyName(): string { return 'slug'; }
}
