<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.settings.index');
    }

    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        $setting->update($request->validated());
        $logoName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('images'), $logoName);
        $setting->update(['logo' =>'images/'. $logoName]);
        return redirect()->route('dashboard.settings.index')->with('success', 'تم التحديث بنجاح ')->with('logo', $logoName);
    }
}
