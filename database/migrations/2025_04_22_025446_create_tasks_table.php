<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
         Schema::create('tasks', function (Blueprint $table) {
             $table->bigIncrements('id');       // BigInt primary key
             $table->string('title');            // Title field as string
             $table->text('description')->nullable(); // Description as text (nullable)
             $table->boolean('is_completed')->default(false); // Boolean flag for task status
             $table->timestamps();               // created_at and updated_at columns
         });
    }

    public function down()
    {
         Schema::dropIfExists('tasks');
    }
}
