<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_experts', function (Blueprint $table) {
            $table->id();
            $table->string("email")->nullable();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->string("city")->nullable();
            $table->string("address")->nullable();
            $table->text("note")->nullable();
            $table->date("date")->nullable();
            $table->foreignId("user_id")->nullable()->constrained("users");
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
        Schema::dropIfExists('contact_experts');
    }
}
