<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mime_type');
            $table->foreignId('user_id')->index()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('files');
        }
    }
};
