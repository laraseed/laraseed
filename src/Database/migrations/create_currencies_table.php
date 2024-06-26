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
        if (!Schema::hasTable('currencies')) {
            Schema::create('currencies', function (Blueprint $table) {
                $table->id();
                $table->string('code', 3)->unique();
                $table->string('country_code', 2)->nullable();
                $table->string('name');
                $table->string('symbol')->nullable();
                $table->string('prefix')->nullable();
                $table->string('suffix')->nullable();
                $table->string('decimal_point')->nullable();
                $table->string('thousands_separator')->nullable();
            });
        }
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};