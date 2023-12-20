<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Passcode extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'passcode';
    protected $primaryKey = 'id_passcode';

    protected $fillable = ['password'];
}
