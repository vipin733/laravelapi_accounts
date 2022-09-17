<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
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
        $avatar = Str::upper($this->first_name)[0];
        if($this->last_name) {
            $avatarL = Str::upper($this->last_name)[0];
            $avatar = $avatar.$avatarL;
        }
        $fullname = Str::title($this->full_name);

        return [
            "full_name"  => $fullname,
            "first_name" => $this->first_name,
            "last_name"  => $this->last_name,
            "email"      => $this->email,
            "username"   => $this->username,
            "contact_no" => $this->contact_no,
            "created_at" => $this->created_at->format("Y-m-d"),
            "is_admin"   => $this->is_admin ? true : false,
            "avatar"     => $avatar,
            "id"         => $this->id
        ];
    }
}
