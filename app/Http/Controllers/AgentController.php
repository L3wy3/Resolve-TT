<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;

class AgentController extends Controller
{
    protected $fillable = [
        'target'];
       public function showdata()
    {
        // This doesn't feel efficient but making a field in the database to hold the achievement % didn't either
        $agents = Agent::orderByRaw('current_sales / target ASC')->get();
		return view('agents',compact('agents'));
    }

    public function updateTarget(Request $request,$id) {
        $agents = Agent::orderByRaw('current_sales / target ASC')->get();
        $combinedTarget = Agent::sum('target');
        $combinedSales = Agent::sum('current_sales');
        $agent = Agent::findOrFail($id);
        $agent->target = $request->input('updateTarget');
        $agent->save();
        $agent->refresh();
        return view('agents',compact('agents','combinedTarget','combinedSales'));
    }
}
