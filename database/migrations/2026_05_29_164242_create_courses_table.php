<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            //Create Course
            $table->integer('category_id');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->longText('description');
            $table->longText('about_instructor')->nullable();
            $table->string('playlist_url');
            $table->string('tags')->nullable(); //laravel, php, html
            $table->string('photo')->nullable;
            $table->string('promo_video_url')->nullable();
            $table->string('creator_status')->default(0); //live=1 or live=0
            $table->string('admin_status')->default(0); //live=1 or live=0

            //target your students
            $table->longtext('what_will_students_learn')->nullable();
            $table->longtext('target_students')->nullable();
            $table->longtext('requirements')->nullable();

            //price and coupons

            $table->double('discount_price', 10, 2);
            $table->double('actual_price', 10, 2);

            //stats

            $table->integer('view_count')->default(0);
            $table->integer('subscriber_count')->default(0);
   
            $table->softDeletes(); //deleted_at
            $table->timestamps(); //created_at updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
