<?php

namespace App\Http\Controllers;

use auth;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\User;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Requests\SearchRequest;



class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except(['index','show','search']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $events = Event::where('date','>=', Carbon::now())->Paginate(6);

        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        /* upload Image */
        $image = $request->file('image');  
        $imageFullName = $image->getClientOriginalName();
        $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $file = time() . '_' . $imageName . '.' . $extension;
        $image->move('images/events',$file);

        $slug = new Slugify();

        Event::create([
          'name' => ucfirst($request->name),
          'slug' => $slug->slugify($request->name),
          'date' => $request->date,
          'nbrPlaces' => $request->nbrPlaces,
          'image'  =>  $file,
          'description' => ucfirst($request->description)
        ]);

        return response()->json('added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($evenement)
    {
        $event = Event::where('slug',$evenement)->firstOrFail();

        $events = Event::where('slug','!=',$evenement )->get();

        return view('events.show',compact('event','events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $event = Event::where('slug',$slug)->firstOrFail();

        return view('events.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $slug)
    {
        $event = Event::where('slug',$slug)->firstOrfail();
        $slug = new Slugify();

        $event->name = ucfirst($request->name);
        $event->slug = $slug->slugify($request->name);
        $event->date = $request->date;
        $event->nbrPlaces = $request->nbrPlaces;
        $event->description = ucfirst($request->description);

        if( $request->file('image') )
         {
            $image = $request->file('image');
            $imageFullName = $image->getClientOriginalName();
            $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $file = time() . '_' . $imageName . '.' . $extension;
            $image->move('images/events',$file);
    
            $event->image = $file;
         }
        
        $event->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $image_path = public_path('images/events/'.$event->image);
        unlink($image_path);
        $event->delete();

        return response()->json('deleted');
    }


    public function search(SearchRequest $request)
    {
        $query = $request->input('q');

        $events = Event::where('name','like',"%$query%")
                        ->orWhere('description','like',"%$query%")
                        ->paginate(6);

        return view('events.search',compact('events'));
    }

    public function listEvent()
    {
        $events = Event::Paginate(5);

        return view('admin.event',compact('events'));
    }



    public function register($id)
    {  
       
        $event = Event::findOrFail($id);
        $user = User::find(auth::id());
       
        if($user->registered == true && $user->events->contains($id))
        {
            return response()->json('already registred');

        }else
        {
            $event->decrement('nbrPlaces');
            $user->registred = true;

            $user->events()->attach($id);
            $event->users()->attach(auth::id());
           
            return response()->json('success');
        }
        
    }

}
