<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title', 512);
            $table->mediumText('head');
            $table->mediumText('body');
            $table->unsignedMediumInteger('views')->default(0);
            $table->unsignedMediumInteger('thumbs_up')->default(0);
            $table->unsignedMediumInteger('thumbs_down')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
