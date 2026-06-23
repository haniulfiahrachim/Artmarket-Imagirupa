<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('instagram')->nullable()->after('link_portofolio');
            $table->string('twitter')->nullable()->after('instagram');
            $table->string('facebook')->nullable()->after('twitter');
            $table->string('youtube')->nullable()->after('facebook');
            $table->string('tiktok')->nullable()->after('youtube');
            $table->string('website')->nullable()->after('tiktok');
            $table->string('spesialisasi')->nullable()->after('website');
            $table->string('kota')->nullable()->after('spesialisasi');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'instagram', 'twitter', 'facebook',
                'youtube', 'tiktok', 'website',
                'spesialisasi', 'kota',
            ]);
        });
    }
};
