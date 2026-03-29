<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    public function index(){
        return view('events');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'name' => 'required|string|max:255',
            'time' => 'required',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if($request->hasfile('image') && $request->file('image')->isValid()){
        
            $path = $request->file('image')->store('events', 'public');
            $validated['image'] = $path; // events/arquivo.jpg
        }

        Event::create($validated);

        return redirect()->route('dashboard')->with('msg', 'Evento criado com sucesso!');
    }
}
