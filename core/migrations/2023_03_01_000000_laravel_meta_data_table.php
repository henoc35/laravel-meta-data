<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = Config::get('meta_data.tables');
        Schema::create($tables['user_meta'], function (Blueprint $table) {
            $table->id();
            $table->string("meta_key", 150);
            $table->text("meta_value")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")
            ->references('id')
                ->on("users")
                ->onDelete("cascade");
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
        $tables = Config::get('meta_data.tables');
        Schema::dropIfExists($tables['user_meta']);
    }
};
