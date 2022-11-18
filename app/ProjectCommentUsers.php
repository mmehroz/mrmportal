<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCommentUsers extends Model
{
   	protected $guarded = [];

 	public function user() {
                 return $this->hasOne(User::class, 'id', 'member_id');
          }    

        public function comment()
        {
                return $this->belongsTo(ProjectComments::class);
        }  

}
