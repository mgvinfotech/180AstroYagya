<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $input = $request->except(['_token', '_method', 'site_logo_file', 'favicon_file']);

        if ($request->hasFile('site_logo_file')) {
            $request->validate([
                'site_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            ]);
            $file = $request->file('site_logo_file');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            $input['site_logo'] = $filename;
        }

        if ($request->hasFile('favicon_file')) {
            $request->validate([
                'favicon_file' => 'nullable|mimes:jpeg,png,jpg,webp,svg,ico|max:1024',
            ]);
            $file = $request->file('favicon_file');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            $input['site_favicon'] = $filename;
        }

        foreach ($input as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Sanctuary and website configurations updated successfully.');
    }
}
