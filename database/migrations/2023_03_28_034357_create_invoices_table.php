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
        // Schema::create('invoices', function (Blueprint $table) {
        //     $table-> bigIncrements('id');
        //     $table -> integer('invoice_number');
        //     $table -> date('data');
        //     $table -> date('due_data');
        //     $table -> string('product');
        //     $table -> string('section');
        //     $table -> integer('discount');
        //     $table -> string('rate_vat');
        //     $table -> decimal('value_vat', 8, 2);
        //     $table -> decimal('total', 8, 2);
        //     $table -> string('status', 50);
        //     $table -> integer('value_status');
        //     $table -> text('note') -> nullable();
        //     $table -> string('user', 30);
        //     $table -> softDeletes();
        //     $table->timestamps();
        // });

        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number', 50);
            $table->date('invoice_Date')->nullable();
            $table->date('Due_date')->nullable();
            $table->string('product', 50);

            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->cascadeOnDelete();

            // $table->bigInteger('product_id')->unsigned();
            // $table->foreign('product_id')
            //     ->references('id')
            //     ->on('products')
            //     ->cascadeOnDelete();

            $table->decimal('Amount_collection', 8, 2)->nullable();;
            $table->decimal('Amount_Commission', 8, 2);
            $table->decimal('Discount', 8, 2);
            $table->decimal('Value_VAT', 8, 2);
            $table->string('Rate_VAT', 999);
            $table->decimal('Total', 8, 2);
            $table->string('Status', 50);
            $table->integer('Value_Status');
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
