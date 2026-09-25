<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void { Schema::create('articles',function(Blueprint $table){
        $table->id();$table->string('slug')->unique();$table->string('title');$table->text('excerpt');
        $table->string('author');$table->string('category')->index();$table->text('image')->nullable();
        $table->text('source_url');$table->timestamp('published_at')->index();$table->timestamps();
    }); }
    public function down(): void { Schema::dropIfExists('articles'); }
};
