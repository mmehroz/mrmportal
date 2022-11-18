<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComments extends Model
{
   	protected $guarded = [];

        public function user() 
        {
            return $this->hasOne(User::class, 'id', 'user_id');
        }  

        public function project()
        {
                return $this->belongsTo(Project::class);
        }  

        public function comment_members() 
        {
            return $this->hasMany(ProjectCommentUsers::class, 'comment_id', 'id');
        }  

}
