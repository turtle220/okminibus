<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckInvoice extends Model
{
    //

    protected $table = "checkinvoices";

    protected $fillable = ["user_id", "invoice_id"];
}