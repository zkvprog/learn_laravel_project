<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('comments', function (Blueprint $table) {
            if (Schema::hasColumn('comments', 'article_id')) {
                $table->renameColumn('article_id', 'resource_id');
            }
            $table->string('resource_type', 20)->comment('Тип ресурса');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            if (Schema::hasColumn('comments', 'resource_type')) {
                $table->dropColumn('resource_type');
            }

            if (Schema::hasColumn('comments', 'resource_id')) {
                $table->renameColumn('resource_id', 'article_id');
            }
        });
    }
}
