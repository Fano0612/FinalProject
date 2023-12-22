<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Karyawan extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = ['email','nama','nomor_telepon', 'username', 'password','jabatan','status','status_belanja_bantuan_karyawan','gambar'];
    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
}
