<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Attachment;
use Illuminate\Support\Facades\Gate;

class AttachmentController extends Controller
{
	private $model, $section, $components;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->section = new \stdClass();
        $this->section->title = 'Attachments';
        $this->section->heading = 'Attachments';
        $this->section->slug = 'attachments';
        $this->section->folder = 'attachments';
    }
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
       
	}

    public function create()
    {
       
    }

    public function store(Request $request)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Category $category)
   {
       
   }

   public function addNewAttachment(Request $request)
   {
       if($request->has('attachments')){
            $lastIds = [];
            foreach ($request->attachments as $key => $attachment){
              $data =   Attachment::create([
                    'name' => $attachment->getClientOriginalName(),
                    'type' => $attachment->getMimeType()
                ]);
                $lastIds[$key] = $data->id;
                $attachment->move(public_path('attachments'),$attachment->getClientOriginalName());
            }
        return $lastIds;
        }
        return null;
   }
}
