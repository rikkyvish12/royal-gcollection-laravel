<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->nullable()->constrained()->onDelete('set null');
            $table->string('url');
            $table->string('title')->nullable();
            $table->string('referrer')->nullable();
            $table->unsignedInteger('time_on_page')->nullable(); // in seconds
            $table->timestamp('viewed_at')->useCurrent();
            $table->timestamps();
            
            $table->index(['url']);
            $table->index(['viewed_at']);
            $table->index(['visitor_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
