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
        Schema::create('zzz_chars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link');
            $table->string('image');
            $table->string('element');
            $table->string('element_picture');
            $table->string('tier');
            $table->timestamps();
        });

        Schema::create('zzz_diskdrives', function(Blueprint $table){
            $table->id();
            $table->foreignId('zzz_char_id')->constrained('zzz_chars')->onDelete('cascade');
            $table->string('name');
            $table->string('detail_2pc');
            $table->string('detail_4pc');
            $table->timestamps();
        });

        Schema::create('zzz_bestdiskdrivestats', function(Blueprint $table){
            $table->id();
            $table->foreignId('zzz_char_id')->constrained('zzz_chars')->onDelete('cascade');
            $table->string('disk_number');
            $table->string('substats');
            $table->string('endgame_stats');
            $table->timestamps();
        });

        Schema::create('zzz_wengines', function(Blueprint $table){
            $table->id();
            $table->foreignId('zzz_char_id')->constrained('zzz_chars')->onDelete('cascade');
            $table->string('build_name');
            $table->string('build_s');
            $table->string('w_engine_picture');
            $table->string('detail');
            $table->string('rarity');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zzz_wengines');
        Schema::dropIfExists('zzz_diskdrives');
        Schema::dropIfExists('zzz_bestdiskdrivestats');
        Schema::dropIfExists('zzz_chars');
    }
};
