<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class GeneralManagerOperasional extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'generalmanageroperasional';
    protected $primaryKey = 'id_generalmanageroperasional';
    protected $fillable = ['email', 'nama', 'nomor_telepon', 'username', 'password', 'jabatan', 'status', 'gambar'];

}
