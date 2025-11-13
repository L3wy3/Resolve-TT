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
        $combinedTarget = Agent::sum('target');
        $combinedSales = Agent::sum('current_sales');
		return view('agents',compact('agents','combinedTarget','combinedSales'));
    }

    public function updateTarget(Request $request,$id) {
        $combinedTarget = Agent::sum('target');
        $combinedSales = Agent::sum('current_sales');
        $agent = Agent::findOrFail($id);
        $agent->target = $request->input('updateTarget');
        $agent->save();
        $agents = Agent::orderByRaw('current_sales / target ASC')->get();
        return view('agents',compact('agents','combinedTarget','combinedSales'));
    }
}
