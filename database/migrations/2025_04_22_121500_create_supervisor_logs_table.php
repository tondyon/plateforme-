<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('supervisor_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('action'); // export, view_stats, etc.
            $table->json('details')->nullable();
            $table->ipAddress('ip_address');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supervisor_logs');
    }
};
