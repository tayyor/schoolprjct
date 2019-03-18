<?php

namespace App\Http\Resources;

use App\ProjectEvaluation;
use Illuminate\Http\Resources\Json\Resource;
use App\Core\Helpers;

class ProjectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'geo'=> Helpers::convertPointsToDegree($this->location),
            'my_evaluation'=> ProjectEvaluation::where('project_id', $this->id)
                ->where('user_id', $request->user()->id)
                ->get()->first()
        ]);
    }

//    public function with($request){
//    }
}
