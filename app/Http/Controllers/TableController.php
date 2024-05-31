<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function table($id)
    {
        $table = Tables::where('id', $id)->get();
        return view('Tables.table', compact('table'));
    }
}
