<?php

namespace App\Http\Repositories;

use Illuminate\Http\Request;

interface QueryRepository
{
    public function query(Request $request);
}
