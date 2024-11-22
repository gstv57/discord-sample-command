<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('job_id')->unique();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('advertiser')->nullable();
            $table->string('location')->nullable();
            $table->text('detail')->nullable();
            $table->string('work_type')->nullable();
            $table->string('salary')->nullable();
            $table->string('posted_at')->nullable();
            $table->text('job_details')->nullable();
            $table->timestamps();
            $table->dateTime('last_sent_at')->nullable();
            $table->index(['title', 'advertiser', 'location', 'work_type', 'salary', 'posted_at', 'job_details']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
