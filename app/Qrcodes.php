<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Qrcodes extends Model
{
    use SyncsWithFirebase;
}
