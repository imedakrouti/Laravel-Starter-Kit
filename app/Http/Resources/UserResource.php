<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            // "role"  => [
            //     "id"   => $this->roles->first()->id,
            //     "name" => $this->roles->first()->display_name,
            // ],
            "roles"=>$this->roles->pluck('name'),
            "role"=>$this->roles->first()->name,
            //"permission"  => PermissionResource::collection($this->allPermissions()->get('name'))
            'permissions'=>$this->allPermissions()->pluck('name')
           // 'image' => $this->image_path,
        ];

    }
}
