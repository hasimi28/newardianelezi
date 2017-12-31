<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $ev = Event::all();
        return view('backend.pages.event')->withEv($ev);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.add_event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        redirect('backend/event');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Event::find($id)->delete();
       return redirect()->back()->with('success','Eventi u fshi me sukses');

    }
}
