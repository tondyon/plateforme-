<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('certificate_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('verification_code');
            $table->string('ip_address');
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->index('verification_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificate_verifications');
    }
};
