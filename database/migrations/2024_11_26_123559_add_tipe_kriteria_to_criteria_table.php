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
    Schema::table('criteria', function (Blueprint $table) {
        $table->string('tipe_kriteria')->after('nilai_kriteria'); // Tambahkan kolom tipe kriteria
    });
}

public function down()
{
    Schema::table('criteria', function (Blueprint $table) {
        $table->dropColumn('tipe_kriteria');
    });
}

};
