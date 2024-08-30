<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('cover_img')->nullable();
            $table->integer('job_category_id')->nullable();
            $table->integer('job_type_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('job_description');
            $table->string('country');
            $table->string('city');
            $table->string('zipcode',10);
            $table->decimal('min_salary',9,2)->nullable();
            $table->decimal('max_salary',9,2)->nullable();
            $table->integer('salary_type_id')->nullable();
            $table->integer('experiance_id')->nullable();
            $table->string('min_experiance_year')->nullable();
            $table->string('job_functions')->nullable();
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
        Schema::dropIfExists('post_jobs');
    }
};
