<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('team_id')->nullable();
            $table->string('title')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('file_type')->nullable();
            $table->text('description')->nullable();
            $table->morphs('fileable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
