<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('doc_acccess', function (Blueprint $table) {
      $table->id('access_id');
      $table->string('access_name', 32)->unique();
    });

    Schema::create('docs_status', function (Blueprint $table) {
      $table->id('docs_status_id');
      $table->string('docs_status_name', 64)->unique();
      $table->boolean('active')->default(true);
    });

    Schema::create('docs_type', function (Blueprint $table) {
      $table->id('docs_type_id');
      $table->string('docs_type_name', 64)->unique();
      $table->boolean('active')->default(true);
    });

    Schema::create('priority_id', function (Blueprint $table) {
      $table->id('priority_id');
      $table->string('priority_name', 32)->unique();
    });

    Schema::create('employee', function (Blueprint $table) {
      $table->id('employee_id');
      $table->integer('employee_name');
    });

    Schema::create('files', function (Blueprint $table) {
      $table->id('file_id');
      $table->string('file_path', 256);
      $table->string('file_type', 8)->default('');
      $table->integer('size')->nullable();
      $table->date('date_created')->default(DB::raw('CURRENT_DATE'));
      $table->string('hash', 256)->nullable();
      $table->unsignedBigInteger('employee_id');
    });

    Schema::create('docs', function (Blueprint $table) {
      $table->id('docs_id');
      $table->integer('docs_hash');
      $table->string('docs_name', 32);
      $table->unsignedBigInteger('docs_type_id')->nullable();
      $table->unsignedBigInteger('docs_status_id')->nullable();
      $table->unsignedBigInteger('access_id')->nullable();
      $table->unsignedBigInteger('prioruty_id')->nullable();
      $table->string('absctract', 256)->nullable();
      $table->unsignedBigInteger('parent_docs_id')->nullable();
      $table->dateTime('deadline')->nullable();
      $table->timestamp('date_created')->useCurrent();
      $table->timestamp('date_updated')->useCurrent();

      $table->foreign('docs_type_id')->references('docs_type_id')->on('docs_type');
      $table->foreign('docs_status_id')->references('docs_status_id')->on('docs_status');
      $table->foreign('access_id')->references('access_id')->on('doc_acccess');
      $table->foreign('prioruty_id')->references('priority_id')->on('priority_id');
    });

    Schema::create('docs_employee', function (Blueprint $table) {
      $table->unsignedBigInteger('docs_id');
      $table->unsignedBigInteger('employee_id');
      $table->unsignedBigInteger('position_id')->nullable();
      $table->boolean('signed')->default(false);

      $table->primary(['docs_id', 'employee_id']);
      $table->foreign('docs_id')->references('docs_id')->on('docs');
      $table->foreign('employee_id')->references('employee_id')->on('employee');
    });

    Schema::create('docs_files', function (Blueprint $table) {
      $table->unsignedBigInteger('docs_id');
      $table->unsignedBigInteger('file_id');

      $table->primary(['docs_id', 'file_id']);
      $table->foreign('docs_id')->references('docs_id')->on('docs');
      $table->foreign('file_id')->references('file_id')->on('files');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('docs_files');
    Schema::dropIfExists('docs_employee');
    Schema::dropIfExists('docs');
    Schema::dropIfExists('files');
    Schema::dropIfExists('employee');
    Schema::dropIfExists('priority_id');
    Schema::dropIfExists('docs_type');
    Schema::dropIfExists('docs_status');
    Schema::dropIfExists('doc_acccess');
  }
};