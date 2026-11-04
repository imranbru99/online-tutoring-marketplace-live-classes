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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('domain')->nullable()->unique();
            $table->string('subdomain')->nullable()->unique();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('favicon_url')->nullable();
            $table->string('primary_color')->default('#4f46e5');
            $table->string('default_language')->default('en');
            $table->string('default_currency')->default('USD');
            $table->string('default_timezone')->default('UTC');
            $table->enum('mode', ['single', 'saas'])->default('single');
            $table->enum('status', ['active', 'suspended', 'trial'])->default('active');
            $table->json('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained('businesses')->cascadeOnDelete();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('slug');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->default('BD');
            $table->string('timezone')->default('UTC');
            $table->boolean('is_main')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->json('module_overrides')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['business_id', 'slug']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('business_id')->nullable()->after('id')->constrained('businesses')->nullOnDelete();
            $table->foreignId('current_branch_id')->nullable()->after('business_id')->constrained('branches')->nullOnDelete();
            $table->string('phone')->nullable()->after('email');
            $table->string('avatar_url')->nullable()->after('phone');
            $table->string('timezone')->default('UTC')->after('avatar_url');
            $table->string('locale')->default('en')->after('timezone');
            $table->string('status')->default('active')->after('locale');
            $table->text('bio')->nullable()->after('status');
            $table->json('metadata')->nullable()->after('bio');
            $table->softDeletes();
        });

        Schema::create('user_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->boolean('is_primary')->default(false);
            $table->string('role')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'branch_id']);
        });

        Schema::create('module_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->constrained('businesses')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->cascadeOnDelete();
            $table->string('module_key')->index();
            $table->boolean('is_enabled')->default(true);
            $table->json('settings')->nullable();
            $table->timestamps();

            $table->unique(['business_id', 'branch_id', 'module_key'], 'uniq_biz_branch_mod');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->nullable()->constrained('businesses')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->cascadeOnDelete();
            $table->string('group')->default('general');
            $table->string('key')->index();
            $table->longText('value')->nullable();
            $table->string('type')->default('string');
            $table->boolean('is_public')->default(false);
            $table->timestamps();

            $table->unique(['business_id', 'branch_id', 'group', 'key'], 'uniq_biz_branch_grp_key');
        });

        Schema::create('system_health_logs', function (Blueprint $table) {
            $table->id();
            $table->string('check_type')->index();
            $table->enum('status', ['healthy', 'warning', 'error']);
            $table->json('metrics')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_health_logs');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('module_states');
        Schema::dropIfExists('user_branches');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->dropForeign(['current_branch_id']);
            $table->dropColumn([
                'business_id',
                'current_branch_id',
                'phone',
                'avatar_url',
                'timezone',
                'locale',
                'status',
                'bio',
                'metadata',
            ]);
        });

        Schema::dropIfExists('branches');
        Schema::dropIfExists('businesses');
    }
};
