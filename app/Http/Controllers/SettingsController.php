<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display the settings page with grouped settings
     */
    public function index()
    {
        $settings = [
            'general' => Setting::getByGroup('general'),
            'academic' => Setting::getByGroup('academic'),
            'student' => Setting::getByGroup('student'),
            'faculty' => Setting::getByGroup('faculty'),
            'finance' => Setting::getByGroup('finance'),
            'system' => Setting::getByGroup('system'),
            'security' => Setting::getByGroup('security'),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings for a specific group
     */
    public function update(Request $request, $group)
    {
        $validator = Validator::make($request->all(), [
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable',
            'settings.*.type' => 'required|in:string,integer,boolean,json',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Invalid settings data provided.');
        }

        try {
            foreach ($request->settings as $settingData) {
                Setting::set(
                    $settingData['key'],
                    $settingData['value'],
                    $settingData['type'],
                    $group
                );
            }

            return redirect()->back()->with('success', ucfirst($group) . ' settings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update settings. Please try again.');
        }
    }

    /**
     * Get a specific setting value (API endpoint)
     */
    public function get($key)
    {
        $setting = Setting::where('key', $key)->first();

        if (!$setting) {
            return response()->json(['error' => 'Setting not found'], 404);
        }

        return response()->json([
            'key' => $setting->key,
            'value' => Setting::castValue($setting->value, $setting->type),
            'type' => $setting->type,
            'group' => $setting->group,
        ]);
    }

    /**
     * Update a specific setting (API endpoint)
     */
    public function set(Request $request, $key)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'nullable',
            'type' => 'required|in:string,integer,boolean,json',
            'group' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $setting = Setting::set(
                $key,
                $request->value,
                $request->type,
                $request->group
            );

            return response()->json([
                'message' => 'Setting updated successfully',
                'setting' => $setting,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update setting'], 500);
        }
    }

    /**
     * Reset settings to default values
     */
    public function reset($group = null)
    {
        try {
            if ($group) {
                // Reset specific group
                Setting::where('group', $group)->delete();
            } else {
                // Reset all settings
                Setting::truncate();
            }

            // Re-seed the settings
            $this->callSeeder();

            return redirect()->back()->with('success', 'Settings reset to default values.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reset settings.');
        }
    }

    /**
     * Call the settings seeder
     */
    private function callSeeder()
    {
        $seeder = new \Database\Seeders\SettingSeeder();
        $seeder->run();
    }
}
