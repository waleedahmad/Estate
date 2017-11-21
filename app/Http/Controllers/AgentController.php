<?php

namespace App\Http\Controllers;

use App\Agents;
use App\Layout;
use App\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function getAgents(){
        $users = User::where('type', '=', 'agent')->paginate(20);
        return view('admin.agents')->with('users', $users);
    }

    public function viewAgents(){
        $users = User::where('type', '=', 'agent')->paginate(20);
        switch(Layout::find(3)->layout_name){
            case 'Agent Listing Grid':
                return view('agent.grid')->with('users', $users);
            case 'Agent Listing Grid Sidebar':
                return view('agent.grid_sidebar')->with('users', $users);
            case 'Agent Listing Row':
                return view('agent.row')->with('users', $users);
            case 'Agent Listing Row Sidebar':
                return view('agent.grid_sidebar')->with('users', $users);
        }
    }

    public function toggleFeatured(Request $request){
        $agent = User::find($request->id)->Agent;
        $agent->featured = $request->status;
        if($agent->save()){
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function getAgent($id){
        $agent = User::find($id);
        return view('agent.single')->with('agent', $agent);
    }
}
