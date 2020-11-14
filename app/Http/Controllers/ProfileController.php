<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }

   public function show($profile)
   {
      $user= User::find($profile);

      return view('profile',compact('user'));
   }


   public function update(Request $request,$profile)
   {

      $user = User::find($profile);

      $user->name = $request->name;
      $user->email = $request->email;
      $user->cycle = $request->cycle;
      $user->bio = $request->bio;

      if( $request->file('image') )
      {
         $image = $request->file('image');
         $imageFullName = $image->getClientOriginalName();
         $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
         $extension = $image->getClientOriginalExtension();
         $file = time() . '_' . $imageName . '.' . $extension;
         $image->move('images/users',$file);
         $user->profile_picture = $file;
      }
   
      $user->save();

      return redirect()->back()->with('success','Vos modifications ont été appliquées.');
   }

   public function destroy($profile)
   {
      $user= User::find($profile);

      $user->delete();

      return view('login');
   }


}
