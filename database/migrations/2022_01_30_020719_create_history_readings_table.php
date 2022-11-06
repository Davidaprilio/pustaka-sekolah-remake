<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('book_id');
            $table->bigInteger('long_time')->default(0)->comment('satuan detik');
            $table->integer('last_page')->comment('halaman terakhir dibaca');

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
        Schema::dropIfExists('history_readings');
    }
}
