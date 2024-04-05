<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incorrect_rows', function (Blueprint $table) {
            $table->id();
            $table->jsonb('data');
            $table->foreignId('file_id')->index()->constrained('files');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('incorrect_rows');
        }
    }
};
