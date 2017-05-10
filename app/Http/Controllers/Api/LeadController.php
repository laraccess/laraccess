<?php

namespace App\Http\Controllers\Api;

use App\Campaign;
use App\Http\Controllers\Controller;
use App\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Lead $lead)
    {
        $this->authorize('view', $lead->campaign);

        return response()->json($lead);
    }

    public function create(Request $request, Campaign $campaign)
    {
        $this->validate($request, [
        'name'  => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'url'   => 'required|url',
    ]);

        $lead = Lead::create([
        'campaign_id' => $campaign->id,
        'name'        => $request->input('name'),
        'email'       => $request->input('email'),
        'url'         => $request->input('url'),
    ]);

        return $lead->toJson();
    }

    public function update(Request $request, Lead $lead)
    {
        $this->authorize('update', $lead->campaign);
        $this->validate($request, [
        'name'    => 'required|string|max:255',
        'email'   => 'required|string|email|max:255',
        'url'     => 'required|url',
        'invited' => 'required|boolean',
    ]);

        $lead->name = $request->input('name');
        $lead->email = $request->input('email');
        $lead->url = $request->input('url');
        $lead->invited = $request->input('invited');
        $lead->save();

        return $lead->toJson();
    }

    public function invite(Lead $lead)
    {
        $lead->invited = true;
        $lead->save();

        return $lead->toJson();
    }

    public function delete(Lead $lead)
    {
        $this->authorize('delete', $lead->campaign);
        $lead->delete();
    }
}
