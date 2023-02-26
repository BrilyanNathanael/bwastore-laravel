<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages.dashboard-settings', compact('user', 'categories'));
    }

    public function account()
    {
        $user = Auth::user();
        return view('pages.dashboard-account', compact('user'));
    }

    public function update(Request $request, $redirect)
    {
        // dd($request);
        $data = $request->all();
        // dd($data);
        $item = Auth::user();
        $item->update($data);
        // dd($item);

        return redirect()->route($redirect);
    }
}
