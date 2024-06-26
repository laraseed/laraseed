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
        if (!Schema::hasTable('countries')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('iso_2');
                $table->string('iso_3');
                $table->string('code');
                $table->string('iso_3166_2');
                $table->string('region');
                $table->string('sub_region');
                $table->string('intermediate_region');
                $table->string('region_code');
                $table->string('sub_region_code');
                $table->string('intermediate_region_code');
            });
        }
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};