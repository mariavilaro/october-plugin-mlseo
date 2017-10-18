<?php namespace Fw\Seo\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePagesTable extends Migration
{

    public function up()
    {
        Schema::create('fw_seo_pages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('page');
            $table->string('title');
            $table->string('description');
            $table->string('keywords')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fw_seo_pages');
    }

}
