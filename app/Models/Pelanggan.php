<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Pelanggan extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = ['email','nama','nomor_telepon', 'username', 'password','status','status_belanja_bantuan_karyawan','gambar'];
}

