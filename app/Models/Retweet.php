<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Retweet extends Pivot
{
    protected $table = "retweets";
}
