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
        if (!Schema::hasTable('us_states')) {
            Schema::create('us_states', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code');
                $table->string('capital');
                $table->string('type');
                $table->decimal('area_miles', 10, 3);
            });
        }
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('us_states');
    }
};