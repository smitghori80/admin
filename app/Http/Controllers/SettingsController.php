<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\SettingsDataStoreTypeRequest;

class SettingsController extends Controller
{
    //
    function __construct()
    {
        // $this->middleware('permission:store-data-type', ['only' => ['storeData', 'storeDataType']]);
    }
    public function storeData()
    {

        $settings = Setting::whereIn('name', ['store_data_type'])->get()->pluck('value');

        return view('settings.store_data', compact('settings'));
    }

    public function storeDataType(SettingsDataStoreTypeRequest $request)
    {
        $request->validated();

        Setting::where('name', 'store_data_type')->update(['value' => $request->storeDataType]);

        return redirect(route('settings.storeData'));
    }
}
