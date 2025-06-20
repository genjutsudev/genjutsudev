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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->comment('user_uuid');
            $table->id('nid')->comment('user_id');
            $table->unsignedBigInteger('referrer_nid')->nullable()->comment('referrer_user_id');
            $table->string('type')->comment('тип уч. записи');
            $table->tinyInteger('is_active')->default(true);
            $table->string('profilelink', 32)->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTime('email_changed_at')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('password_changed_at')->nullable();
            $table->string('profilename', 128)->nullable();
            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->decimal('karma', 5)->default(0.0)->comment('репутация пользователя');
            $table->decimal('power', 3)->default(1.0)->comment('сила голоса');
            $table->unsignedInteger('sign_in_count')->default(0)->comment('количество успешных входов');
            $table->string('registration_ip_hash')->nullable();
            $table->string('registration_country')->nullable()->comment('географическое местоположение (страна/город)');
            $table->string('token', 32)->nullable();
            $table->string('api_key', 64)->nullable();
            $table->rememberToken();
            $table->dateTime('activity_at');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unique('id', 'unq_user_users_on_id');
            $table->index('referrer_nid', 'idx_user_users_on_referrer_nid');
            $table->index('type', 'idx_user_users_on_type');
            $table->unique('profilelink', 'unq_user_users_on_profilelink');
            $table->unique('email', 'unq_user_users_on_email');
            $table->index(['type', 'is_active'], 'idx_user_users_on_type_and_is_active');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
