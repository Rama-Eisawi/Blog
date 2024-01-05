<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);

            $table->string('image')->nullable();
            $table->string('title');
            $table->string('slug')->unique(); //what is used in the url, like title without spaces
            $table->text('body'); //content

            $table->timestamp('published_at')->nullable();
            $table->boolean('featured')->default(false); //if true, the post will shown in recommended posts

            $table->softDeletes(); //not active, but not deleted from database

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
