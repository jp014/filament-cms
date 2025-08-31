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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // プロジェクトに紐づく
            $table->string('title'); // タスク名
            $table->text('description')->nullable(); // 詳細
            $table->date('due_date')->nullable(); // 期限
            $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo'); // 進捗状態
            $table->integer('priority')->default(0); // 優先度（数値で管理）
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
