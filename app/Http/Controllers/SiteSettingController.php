<?php

namespace App\Http\Controllers;


use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    //

    public function index()
    {
        // fetch all site settings
        $siteSettings = SiteSetting::first();
        // dd($siteSettings);
        return view('admin.site-setting.index', compact('siteSettings'));
    }



    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_background_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_banner_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'shop_email' => 'required|email|max:255',
            'slogan' => 'nullable|string|max:255',
            'about_us' => 'nullable|string',
            'promotion_paragraph' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'facebook_name' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_name' => 'nullable|string|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'instagram_name' => 'nullable|string|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        $siteSetting = SiteSetting::first();

        // Handle logo upload
        if ($request->hasFile('logo_path')) {
            // Delete old logo if exists
            if ($siteSetting && $siteSetting->logo_path) {
                $oldPath = str_replace('storage/', '', $siteSetting->logo_path);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new logo
            $path = $request->file('logo_path')->store('site-logos', 'public');
            $validatedData['logo_path'] = $path;
        }

        // Handle home background upload
        if ($request->hasFile('home_background_path')) {
            // Delete old home background if exists
            if ($siteSetting && $siteSetting->home_background_path) {
                $oldPath = str_replace('storage/', '', $siteSetting->home_background_path);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new home background
            $path = $request->file('home_background_path')->store('home-backgrounds', 'public');
            $validatedData['home_background_path'] = $path;
        }

        // Handle about banner upload
        if ($request->hasFile('about_banner_path')) {
            // Delete old about banner if exists    
            if ($siteSetting && $siteSetting->about_banner_path) {
                $oldPath = str_replace('storage/', '', $siteSetting->about_banner_path);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            // Store new about banner
            $path = $request->file('about_banner_path')->store('about-banners', 'public');
            $validatedData['about_banner_path'] = $path;
        }

        if ($siteSetting) {
            $siteSetting->update($validatedData);
        } else {
            SiteSetting::create($validatedData);
        }


        // return redirect()->route('admin.site-setting.index')->with('success', 'Site settings updated successfully.');
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.site-setting.index')->with('success', 'Site settings updated successfully.');
        } else {
            return redirect()->route('superadmin.site-setting.index')->with('success', 'Site settings updated successfully.');
        }
    }
}
