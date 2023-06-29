<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cms;
use Illuminate\Support\Facades\File;

class CmsController extends Controller
{
    public function cmsShow() {
        $cms = Cms::first();
        return view('admin.settings', compact('cms'));
    }

    public function cmsUpdate(Request $request){
        // Validate data
        $request->validate([
            'site_logo'=> 'nullable|mimes:jpeg,jpg,png,svg|max:15000',
            'site_email'=> 'required|email',
            'site_mobile'=> 'required',
            'site_support_text'=> 'required',
            'site_address'=> 'required',
            'free_shipping_text'=> 'required',
            'facebook_url'=> 'required|url',
            'twitter_url'=> 'required|url',
            'linkedin_url'=> 'required|url',
            'pinterest_url'=> 'required|url',
            'newsletter_text'=> 'required',
            'copyright_text'=> 'required',
            'payment_method_img'=> 'nullable|mimes:jpeg,jpg,png,svg|max:15000',
            'business_open_time'=> 'required',
            'google_map_url'=> 'required|url',
            'banner_category_name'=> 'required',
            'banner_title'=> 'required',
            'banner_text'=> 'required',
            'banner_img'=> 'nullable|mimes:jpeg,jpg,png,svg|max:15000',
        ]);

        $cms = Cms::first();

        // Logo photo
        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $filename = $file->hashName();
            $file->move('uploads/cms', $filename);

            // Delete previous photo
            if ($cms->site_logo !== 'frontend/assets/img/logo.png') {
                $previousPhotoPath = public_path($cms->site_logo);
                if (file_exists($previousPhotoPath)) {
                    File::delete($previousPhotoPath);
                }
            }

            $cms->site_logo = 'uploads/cms/' . $filename; // Set the new profile photo URL
        }
        // Logo photo

        // payment method photo
        if ($request->hasFile('payment_method_img')) {
            $file2 = $request->file('payment_method_img');
            $filename2 = $file2->hashName();
            $file2->move('uploads/cms', $filename2);

            // Delete previous photo
            if ($cms->payment_method_img !== 'frontend/assets/img/payment-item.png') {
                $previousPhotoPath2 = public_path($cms->payment_method_img);
                if (file_exists($previousPhotoPath2)) {
                    File::delete($previousPhotoPath2);
                }
            }

            $cms->payment_method_img = 'uploads/cms/' . $filename2; // Set the new profile photo URL
        }
        // payment method photo

        // payment method photo
        if ($request->hasFile('banner_img')) {
            $file3 = $request->file('banner_img');
            $filename3 = $file3->hashName();
            $file3->move('uploads/cms', $filename3);

            // Delete previous photo
            if ($cms->banner_img !== 'frontend/assets/img/hero/banner.jpg') {
                $previousPhotoPath3 = public_path($cms->banner_img);
                if (file_exists($previousPhotoPath3)) {
                    File::delete($previousPhotoPath3);
                }
            }

            $cms->banner_img = 'uploads/cms/' . $filename3; // Set the new profile photo URL
        }

        $cms->update([
            // 'home_banner_img'=> $request->home_banner_img,
            'site_email'=> $request->site_email,
            'site_mobile'=> $request->site_mobile,
            'site_support_text'=> $request->site_support_text,
            'site_address'=> $request->site_address,
            'free_shipping_text'=> $request->free_shipping_text,
            'facebook_url'=> $request->facebook_url,
            'twitter_url'=> $request->twitter_url,
            'linkedin_url'=> $request->linkedin_url,
            'pinterest_url'=> $request->pinterest_url,
            'newsletter_text'=> $request->newsletter_text,
            'copyright_text'=> $request->copyright_text,
            'business_open_time'=> $request->business_open_time,
            'google_map_url'=> $request->google_map_url,
            'banner_category_name'=> $request->banner_category_name,
            'banner_title'=> $request->banner_title,
            'banner_text'=> $request->banner_text,
        ]);

        return back()->with('success', 'Site Content Updated Successfully');
    }
}
