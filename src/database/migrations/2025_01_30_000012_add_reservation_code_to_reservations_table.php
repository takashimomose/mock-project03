<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReservationCodeToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->uuid('reservation_code')->unique()->after('people');
            $table->unsignedBigInteger('reservation_status_id')->after('reservation_code');

            $table->foreign('reservation_status_id')->references('id')->on('reservation_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('reservation_code');
            $table->dropColumn('reservation_status_id');
        });
    }
}
