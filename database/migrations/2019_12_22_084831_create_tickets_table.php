<?php

use App\Models\Ticket;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateTicketsTable
 */
class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('tickets',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->softDeletes();
                $table->string('title');
                $table->longText('description')
                    ->nullable();
                $table->timestamp('term')
                    ->nullable();
                $table->bigInteger('executor_id')
                    ->nullable();
                $table->smallInteger('priority')
                    ->default(Ticket::PRIORITY_LOW);
                $table->smallInteger('status')
                    ->default(Ticket::STATUS_NEW);
                $table->bigInteger('created_user_id')
                    ->nullable();
                $table->bigInteger('updated_user_id')
                    ->nullable();
            });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
