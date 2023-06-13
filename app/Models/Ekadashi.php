<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekadashi extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function tomorrow()
    {
        $tomorrow = self::all()->filter(function ($ekadashi) {
            return $ekadashi->date === Carbon::now()->timezone('Europe/Paris')->addDay()->toDateString();
        });

        if ($tomorrow->isEmpty())
            return false;

        return $tomorrow->first();
    }
}
