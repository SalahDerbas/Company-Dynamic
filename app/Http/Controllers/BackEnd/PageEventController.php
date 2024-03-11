<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageEvent;
use App\Models\Language;

class PageEventController extends Controller
{
    
    public function index()
    {
        $languages = Language::orderBy('id','desc')->get();
        return view('backEnd.view-page-event',compact('languages'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $page_event = PageEvent::where('lang_id',$id)->first();
        return view('backEnd.view-page-event-edit',compact('page_event'));
    }

    
    public function update(Request $request, $id)
    {
        if(env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }
        
        $page_event = PageEvent::findOrFail($id);
        $page_event->update([
            'event_heading' => $request->event_heading,
            'mt_event'      => $request->mt_event,
            'md_event'      => $request->md_event
        ]);

        notify()->success(A_SUCCESS_DATA_UPDATE, A_SUCCESS);
        return redirect()->route('page-events.index');
    }

    
    public function destroy($id)
    {
        //
    }
}
