<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
		if (!Schema::hasTable('notes')) {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->unsigned(); 
            $table->string('title');
            $table->text('content');
			$table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
		}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
};