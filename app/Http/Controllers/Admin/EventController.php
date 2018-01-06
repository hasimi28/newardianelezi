<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('read-event')) {

        $ev = Event::all();
        return view('backend.pages.event')->withEv($ev);

        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('create-event')) {

        return view('backend.pages.add_event');

        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (Auth::user()->can('create-event')) {
        $event = new Event;

        $this->validate($request, [
            'title_sq' => 'required',
            'title_de' => 'required',
            'text_sq' => 'required',
            'text_de' => 'required',
            'image'   => 'image|required',
            'datetime'   => 'required',

        ]);

        $event->ti_sq = $request->title_sq;
        $event->ti_de = $request->title_de;
        $event->des_sq = $request->text_sq;
        $event->des_de = $request->text_de;
        $event->adress = $request->adress;


        $event->datetime = $request->datetime;

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('postimages/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);

            if(file_exists('postimages/'.$event->image)){
                @unlink('postimages/'.$event->image);
            }

            $event->image = $filename;
        }

        $event->save();

            return redirect('backend/event')->with('success','Eventi u shtua me sukses');


        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->can('read-event')) {

            $ev = Event::all();
            return view('backend.pages.event')->withEv($ev);

        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->can('update-event')) {

        $ev = Event::find($id);
        return view('backend.pages.edit_event')->withEv($ev);

        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        if (Auth::user()->can('update-event')) {

        $event = Event::find($id);

        $this->validate($request, [
            'title_sq' => 'required',
            'title_de' => 'required',
            'text_sq' => 'required',
            'text_de' => 'required',
            'datetime'   => 'required',

        ]);

        $event->ti_sq = $request->title_sq;
        $event->ti_de = $request->title_de;
        $event->des_sq = $request->text_sq;
        $event->des_de = $request->text_de;
        $event->adress = $request->adress;


        $event->datetime = $request->datetime;

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('postimages/' . $filename);
            Image::make($image)->resize(800, 600)->save($location);

            if(file_exists('postimages/'.$event->image)){
                @unlink('postimages/'.$event->image);
            }

            $event->image = $filename;
        }

        $event->save();

        return redirect('backend/event')->with('success','Ky Event u ndryshua me sukses');


        } else{

            return redirect()->back()->with('success','Nuk keni qasje');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $val = input::get('val');
        if (Auth::user()->can('delete-event')) {

       Event::find($val)->delete();

            return response()->json([
                'success' => true,
                'status' => 'success'
            ], 200);


        } else{

            return response()->json([
                'success' => false,
                'status' => 'Nuk keni qasje'
            ], 200);
        }
    }
}
