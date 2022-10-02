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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->collation('utf8_bin')->unique();
            $table->string('email')->collation('utf8_bin')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('icon')->nullable();
            $table->string('password');
            $table->integer('role')->default(3); // 0 = root, 1 = admin, 2 = mod, 3 = user
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
