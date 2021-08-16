<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyMessage extends Model
{
    use HasFactory;
    protected $fillable = ['id_user', 'id_message', 'body'];
}
