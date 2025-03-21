<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $fillable = ['site_name', 'address', 'phone', 'email_contact', 'logo'];

    // Obtén la configuración desde la base de datos
    // $config = Config::first();

    // return [
    //     'title' => $config ? $config->site_name : 'AdminLTE',
    //     'logo' => $config ? '<b>' . $config->site_name . '</b>LTE' : '<b>Admin</b>LTE',
    //     'logo_img' => $config && $config->logo ? 'storage/' . $config->logo : 'vendor/adminlte/dist/img/HEBRON.png',
    //     'logo_img_class' => 'brand-image img-circle elevation-3',
    //     'logo_img_xl' => null,
    //     'logo_img_xl_class' => 'brand-image-xs',
    //     'logo_img_alt' => $config ? $config->site_name : 'JDeveloper',
    // ];
}

