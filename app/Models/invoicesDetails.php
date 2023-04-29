<?php

namespace App\Models;

// use App\Invoices;
// use App\InvoicesAttachments;
// // use App\Models\InvoicesDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoicesDetails extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'invoice_id',
        'invoice_number',
        'product',
        'Section',
        'Status',
        'Value_Status',
        'note',
        'user',
        'Payment_Date',
    ];
    // protected $guarded[];
}
