<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cpvd extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\CpvdFactory> */
    use HasFactory;
    use \OwenIt\Auditing\Auditable;



}
