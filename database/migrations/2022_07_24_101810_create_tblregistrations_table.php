<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblregistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //     Schema::create('tblregistrations', function (Blueprint $table) {
    //         $table->id('userid');
    //         $table->string('fullname',30);
    //         $table->date('dob');
    //         $table->integer('age');
    //         $table->integer('status');
    //         $table->timestamps();
    //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblregistrations');
    }
}
