<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private function getContent()
    {
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();
        return $settings;
    }

    private function saveContent(array $data)
    {
        foreach ($data as $key => $value) {
            DB::table('settings')->upsert(
                ['key' => $key, 'value' => $value],
                ['key'],
                ['value']
            );
        }
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function landing()
    {
        $content = $this->getContent();
        return view('admin.landing', compact('content'));
    }

    public function updateLanding(Request $request)
    {
        $data = [
            'hero_badge'    => $request->hero_badge,
            'hero_title'    => $request->hero_title,
            'hero_subtitle' => $request->hero_subtitle,
            'cta_button'    => $request->cta_button,
            'phone'         => $request->phone,
            'email_contact' => $request->email_contact,
            'whatsapp'      => $request->whatsapp,
            'iklan_text'    => $request->iklan_text,
            'iklan_url'     => $request->iklan_url,
            'footer_text'   => $request->footer_text,
            'feature_1'     => $request->feature_1,
            'feature_2'     => $request->feature_2,
            'feature_3'     => $request->feature_3,
            'testimoni_1'   => $request->testimoni_1,
            'testimoni_2'   => $request->testimoni_2,
            'testimoni_3'   => $request->testimoni_3,
        ];

        $this->saveContent($data);

        return redirect()->route('admin.landing')->with('success', '✅ Landing page berhasil diupdate!');
    }
}

