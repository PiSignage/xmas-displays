<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('displays', function (Blueprint $table) {
            $table->string('website_uri')->nullable()->after('images');
            $table->string('public_email')->nullable()->after('website_uri');
            $table->string('facebook_link')->nullable()->after('public_email');
            $table->string('twitter_link')->nullable()->after('facebook_link');
            $table->string('instagram_link')->nullable()->after('twitter_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('displays', function (Blueprint $table) {
            $table->dropColumn('website_uri');
            $table->dropColumn('public_email');
            $table->dropColumn('facebook_link');
            $table->dropColumn('twitter_link');
            $table->dropColumn('instagram_link');
        });
    }
};
