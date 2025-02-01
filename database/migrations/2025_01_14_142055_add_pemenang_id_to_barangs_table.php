<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('pemenang_id')->nullable();
            $table->foreign('pemenang_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['pemenang_id']);
            $table->dropColumn('pemenang_id');
        });
    }
    
};
