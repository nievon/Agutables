<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.admin', compact('user'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,moder',
        ]);
        $user = User::find($id);
        if (!$user) {
            return redirect()->back();
        }
        $user->rule = $request->input('role');
        $user->save();
        return redirect()->back();
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
    public function addTables(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);
        $table = new Tables();
        $table->name = $request->input('name');
        $table->url = $request->input('url');
        $table->save();
        return redirect()->back();
    }

    public function addTablesview()
    {
        return view('admin.createTable');
    }
}
