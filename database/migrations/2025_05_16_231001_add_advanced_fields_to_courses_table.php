<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            // $table->string('niveau')->nullable()->after('description');
            // $table->string('image')->nullable()->after('niveau');
            $table->string('pdf')->nullable()->after('image');
            $table->string('video_url')->nullable()->after('pdf');
            $table->string('video_file')->nullable()->after('video_url');
            $table->boolean('is_published')->default(false)->after('video_file');
        });
    }

    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['niveau', 'image', 'pdf', 'video_url', 'video_file', 'is_published']);
        });
    }
};
