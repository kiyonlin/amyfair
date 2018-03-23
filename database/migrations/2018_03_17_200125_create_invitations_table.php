<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['supplier', 'buyer'])->comment('申请类型');
            $table->string('email');
            $table->string('mobile');
            $table->string('passportNo');
            $table->string('fullName');
            $table->string('country');
            $table->string('industry');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('phone')->nullable();
            $table->string('qq')->nullable();
            $table->string('wechat')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('skype')->nullable();
            $table->string('facebook')->nullable();
            $table->string('corpName')->nullable()->comment('公司名称');
            $table->string('corpAddr')->nullable()->comment('公司地址');
            $table->string('website')->nullable();
            $table->string('source')->nullable();
            $table->string('intent')->nullable();
            $table->string('tradingIntro')->nullable()->comment('贸易描述');

            $table->integer('admin_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
