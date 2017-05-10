<?php

namespace App\Http\Controllers\Api;

use App\Campaign;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Campaign $campaign)
    {
        $this->authorize('view', $campaign);

        return response()->json($campaign);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
        'name'   => 'required|string|max:255|unique:campaigns,name',
        'public' => 'required|boolean|max:255',
    ]);

        $campaign = Campaign::create([
        'user_id' => Auth::id(),
        'name'    => $request->input('name'),
        'public'  => $request->input('public'),
    ]);

        return $campaign->toJson();
    }

    public function update(Request $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);
        $this->validate($request, [
        'name'   => 'required|string|max:255|unique:campaings,name',
        'public' => 'required|boolean|email|max:255',
    ]);

        $campaign->name = $request->input('name');
        $campaign->public = $request->input('public');
        $campaign->save();

        return $campaign->toJson();
    }

    public function delete(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);
        $campaign->delete();
    }

    public function leads(Campaign $campaign)
    {
        $this->authorize('view', $campaign);

        return $campaign->leads->toJson();
    }
}
