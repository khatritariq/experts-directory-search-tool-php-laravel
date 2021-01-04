<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('websites', function (Blueprint $table) {
            $table->id();
            $table->string('url', 100);
            $table->string('short_url', 30);
            $table->foreignId('member_id')->constrained('members')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('website_headings', function (Blueprint $table) {
            $table->id();
            $table->string('header_type', 10);
            $table->string('header_content', 500);
            $table->foreignId('website_id')->constrained('websites')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('friendships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('friend_id')->constrained('members', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->unique(['member_id', 'friend_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendships');
        Schema::dropIfExists('website_headings');
        Schema::dropIfExists('websites');
        Schema::dropIfExists('members');
    }
}
