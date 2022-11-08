<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {

        Schema::create('cinema_owners', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('cinemas', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('total_cinema_halls');
            $table->integer('cinema_owner_id')->unsigned();
            $table->foreign('cinema_owner_id')->references('id')->on('cinema_owners')->onDelete('cascade');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('cinema_halls', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('total_seats');
            $table->integer('cinema_id')->unsigned();
            $table->foreign('cinema_id')->references('id')->on('cinemas')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('cinema_hall_seats', function($table) {
            $table->increments('id');
            $table->integer('seat_number')->index();
            $table->enum('type',['vip_seat','couple_seat','super_vip']);
            $table->integer('cinema_id')->unsigned();
            $table->foreign('cinema_id')->references('id')->on('cinemas')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('movies', function($table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->mediumText('description');
            $table->dateTime('release_date');
            $table->string('language')->index();
            $table->string('genre')->index();
            $table->string('country');
            $table->timestamps();
        });

        Schema::create('shows', function($table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('cinema_hall_id')->unsigned();
            $table->foreign('cinema_hall_id')->references('id')->on('cinema_halls')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('bookings', function($table) {
            $table->increments('id');
            $table->integer('number_of_seats');

            $table->enum('status',['pending','processing','confirmed','failed']);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('show_id')->unsigned();
            $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('show_seats', function($table) {
            $table->increments('id');

            $table->integer('booking_id')->unsigned();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');

            $table->integer('show_id')->unsigned();
            $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
            
            $table->integer('cinema_hall_seat_id')->unsigned();
            $table->foreign('cinema_hall_seat_id')->references('id')->on('cinema_hall_seats')->onDelete('cascade');
            
            $table->decimal('price', 8, 2);

            $table->enum('status',['pending','confirmed']);
            
            $table->timestamps();
        });

        Schema::create('booking_payments', function($table) {
            $table->increments('id');

            $table->integer('booking_id')->unsigned();
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');

            $table->decimal('amount', 8, 2);

            $table->string('payment_method');

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
    }
}
