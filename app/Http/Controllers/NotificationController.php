<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

     public function readNotify(Request $request)
    {
        $user = User::find(auth()->user()->id)
        ->notifications->where('id',$request->notifyId)
        ->markAsRead();
    }  
     public function readAllNotify(Request $request)
    {
        $user = User::find(auth()->user()->id)
        ->unreadNotifications->markAsRead();
    } 
     public function checkNotify(Request $request)
    {
        $notifications = User::find(auth()->user()->id)
        ->notifications()
         ->take(10)->get();
         $alert = 0;
         $newCount = count($notifications);
         $oldCount = $request->oldCount;
         if($newCount > $oldCount){
            $alert = 1;
         }

        if($request->ajax()){
             $view = view('partials.notifications', compact('notifications'))->render();
             return response()->json(['status' => 200, 'view' => $view, 'alert' => $alert]);
        }
    }
}
