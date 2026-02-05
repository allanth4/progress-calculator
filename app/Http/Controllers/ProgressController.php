<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgressController extends Controller
{
    //

    public function calculate(int $a, int $b): int
    {
        return $b * ($a + $b) + 400;


    }
}
