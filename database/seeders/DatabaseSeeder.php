<?php
namespace Database\Seeders;
use App\Models\Article;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        $rows=json_decode(file_get_contents(database_path('data/articles.json')),true,512,JSON_THROW_ON_ERROR);
        foreach($rows as $row){unset($row['id']);Article::updateOrCreate(['slug'=>$row['slug']],$row);}
    }
}
