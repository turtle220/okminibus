<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckMangement extends Model
{
    //

    protected $table = "checkmangements";

    protected $fillable = ["user_id", "bookingticket_id"];
}