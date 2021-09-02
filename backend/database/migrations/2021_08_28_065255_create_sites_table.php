<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->text('url');
            $table->text('image')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->longText('note')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamp('updated_at')->default(\DB::raw('now()::timestamp(0)'));
            $table->timestamp('created_at')->default(\DB::raw('now()::timestamp(0)'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
