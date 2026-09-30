<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class WebsiteSettingController extends Controller
{
    /**
     * Website Settings Edit Page
     */
    public function edit()
    {
        $setting = WebsiteSetting::first();

        return view('backend.settings.edit', compact('setting'));
    }

    /**
     * Update Website Settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'school_name' => ['nullable', 'string', 'max:255'],
            'school_name_bn' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'favicon' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,ico',
                'max:1024'
            ],

            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'mobile' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],

            'facebook' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],

            'footer_text' => ['nullable', 'string'],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Get Existing Setting
        |--------------------------------------------------------------------------
        */

        $setting = WebsiteSetting::first();

        if (!$setting) {
            $setting = new WebsiteSetting();
        }

        /*
        |--------------------------------------------------------------------------
        | Normal Data
        |--------------------------------------------------------------------------
        */

        $data = $request->except([
            'logo',
            'favicon',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Logo Upload
        |--------------------------------------------------------------------------
        |
        | File will be stored in:
        |
        | public/storage/images/school-logo/
        |
        */

        if ($request->hasFile('logo')) {

            // Delete old logo
            if ($setting->logo) {

                $oldLogo = public_path($setting->logo);

                if (file_exists($oldLogo)) {
                    unlink($oldLogo);
                }
            }

            $logo = $request->file('logo');

            $logoName = 'logo_' . time() . '.' .
                $logo->getClientOriginalExtension();

            $logo->move(
                public_path('storage/images/school-logo'),
                $logoName
            );

            /*
            | Database will store:
            | storage/images/school-logo/logo_xxxxx.jpeg
            */

            $data['logo'] =
                'storage/images/school-logo/' . $logoName;
        }

        /*
        |--------------------------------------------------------------------------
        | Favicon Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('favicon')) {

            // Delete old favicon
            if ($setting->favicon) {

                $oldFavicon = public_path($setting->favicon);

                if (file_exists($oldFavicon)) {
                    unlink($oldFavicon);
                }
            }

            $favicon = $request->file('favicon');

            $faviconName = 'favicon_' . time() . '.' .
                $favicon->getClientOriginalExtension();

            $favicon->move(
                public_path('storage/images/school-logo'),
                $faviconName
            );

            /*
            | Database will store:
            | storage/images/school-logo/favicon_xxxxx.png
            */

            $data['favicon'] =
                'storage/images/school-logo/' . $faviconName;
        }

        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $setting->fill($data);
        $setting->save();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Website settings updated successfully.');
    }
}