<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained();
            $table->foreignId('main_category_id')->constrained();
            $table->foreignId('sub_category_id')->constrained()->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('manage_books');

            // $table->foreignId('author_id')->constrained();
            $table->string('title');
            $table->enum('formate',['Paperback','Hardcover'])->nullable();
            $table->string('formate_id')->nullable();
            $table->text('image')->nullable();
            $table->string('isbn');
            $table->string('isbn10')->nullable();
            $table->string('isbn13')->nullable();
            $table->string('language')->nullable();
            $table->string('edition')->nullable();
            $table->string('publisher')->nullable();
            $table->string('author')->nullable();
            $table->timestamp('date_published')->nullable();
            $table->enum('condition',['New','Like New','Good','Acceptable']);
            $table->integer('quantity')->nullable();
            $table->string('dimensions')->nullable();
            // $table->string('width')->nullable();
            // $table->string('height')->nullable();
            // $table->string('length')->nullable();
            // $table->string('weight')->nullable();
            $table->string('pages')->nullable();
            $table->string('price')->nullable();
            $table->enum('status',[1,0])->default(0);
            $table->enum('popular',[1,0])->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manage_books');
    }
}
