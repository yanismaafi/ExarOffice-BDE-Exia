<?php

namespace App\Http\Controllers;

use auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Helpers\ToastNotifier;
use Illuminate\Support\Facades\Storage;


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

    public function listEvent() 
    {
        $events = Event::Paginate(5);
        return view('admin.event',compact('events'));
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

    public function store (Request $request)
    {  
        if(request()->ajax()) {

            $request->validate([
                'name' => 'required|string|min:4|max:100',
                'date' => 'required|date',
                'nbrPlaces' => 'required|integer|min:5',
                'image' =>   'required|mimes:jpg,jpeg,png,webp,gif,svg|max:8388608',
                'description' => 'required|string|min:8',
            ]);

            $event = new Event();
            $event->name = ucfirst($request->name);
            $slug = new Slugify();
            $event->slug = $slug->slugify($request->name);
            $event->date = $request->date;
            $event->nbrPlaces = $request->nbrPlaces;
            $event->description = ucfirst($request->description);
            $this->storeImage($request,$event);
            
            $event->save();

            $notification = new ToastNotifier('success','Évènement ajouté','L\'évènement a été ajouté avec succès',null,null);
            return $notification->toJson();
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
        $event = Event::findOrFail($id);
        $otherEvents = Event::where('id','!=',$id)->get();
       
        return view('events.show',compact('event','otherEvents'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id) 
    {
        $event = Event::findOrFail($id);
        return view('events.edit',compact('event'));
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
        if(request()->ajax()) {

            $request->validate([
                'name' => 'required|min:4|max:100',
                'date' => 'required|date',
                'nbrPlaces' => 'required|integer|min:5',
                'image' =>   'sometimes|mimes:jpg,jpeg,png,webp,gif,svg|max:8388608',
                'description' => 'required|min:8',
            ]);
            
            $event = Event::findOrFail($id);
    
            $slug = new Slugify();
            $event->name = ucfirst($request->name);
            $event->slug = $slug->slugify($request->name);
            $event->date = $request->date;
            $event->nbrPlaces = $request->nbrPlaces;
            $event->description = ucfirst($request->description);
            $this->storeImage($request,$event);
    
            $event->save();
    
            $notification = new ToastNotifier('success','Évènement modifié','L\'évènement a été modifié avec succès','redirectToEventList',null);
            return $notification->toJson();
        }
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|alpha_num',
        ]);

        $query = $request->input('q');

        $events = Event::where('name','like',"%$query%")
                        ->orWhere('description','like',"%$query%")
                        ->paginate(6);

        return view('events.search',compact('events'));
    }


    public function register($id) 
    {  
        $event = Event::findOrFail($id);
        $user = User::find(auth::id());
       
        if($user->registered == true && $user->events->contains($id)){
            return response()->json('already registred');
       
        }else{

            $event->decrement('nbrPlaces');
            $user->registred = true;

            $user->events()->attach($id);
            $event->users()->attach(auth::id());
           
            return response()->json('success');
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
        $event = Event::findOrFail($id);
    
        $image_path = storage_path('app/public/'.$event->image);
        
        if(Storage::disk('public')->exists($event->image))
        {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        $notification = new ToastNotifier('success','Évènement supprimé','L\'évènement a été supprimé avec succès','removeTableRow',$event->id);
        return $notification->toJson();  
    }


    private function storeImage(Request $request, Event $event) 
    {
        if($request->image) 
        {
          $event->image = $request->image->store('Event','public');
        }
    }

}
