<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->string('certificate_verification_code')->nullable()->unique()->after('completed_at');
        });
    }

    public function down()
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->dropColumn('certificate_verification_code');
        });
    }
};
