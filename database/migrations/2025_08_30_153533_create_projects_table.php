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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // プロジェクト名
            $table->text('description')->nullable(); // 説明
            $table->date('start_date')->nullable(); // 開始日
            $table->date('end_date')->nullable();   // 終了日
            $table->enum('status', ['planned', 'in_progress', 'completed', 'on_hold'])->default('planned'); // 状態
            
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
