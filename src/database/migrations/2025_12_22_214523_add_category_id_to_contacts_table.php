<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('contacts', function (Blueprint $table) {
        if (!Schema::hasColumn('contacts', 'category_id')) {
            $table->unsignedBigInteger('category_id')->after('building');
        }

        // 外部キーがまだ無い場合のみ追加
        $table->foreign('category_id')
              ->references('id')
              ->on('categories')
              ->onDelete('cascade');
    });
}


public function down()
{
    Schema::table('contacts', function (Blueprint $table) {
        $table->dropForeign(['category_id']);
        $table->dropColumn('category_id');
    });
}

}
