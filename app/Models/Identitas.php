<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Identitas extends Model
{
	use LogsActivity;

    protected $table  = "identitas";
    protected $fillable = [
    	'instansi','singkatan_instansi','footer','logo_public','logo_backend','logo_login','kepala_dinas','nip_kepala_dinas','bupati','nama_aplikasi','kasubag_umum','nip_kasubag_umum','kabid_pelayanan','nip_kabid_pelayanan','kabid_penanaman_modal','nip_kabid_penanaman_modal','kasek_tinjau_lapangan','nip_kasek_tinjau_lapangan','sekda','petugas_teknis_imb','nip_petugas_teknis_imb','kasie_imb','nip_kasie_imb'
    ];

    protected static $logAttributes = [
    	'instansi','singkatan_instansi','footer','logo_public','logo_backend','logo_login','kepala_dinas','nip_kepala_dinas','bupati','nama_aplikasi','kasubag_umum','nip_kasubag_umum','kabid_pelayanan','nip_kabid_pelayanan','kabid_penanaman_modal','nip_kabid_penanaman_modal','kasek_tinjau_lapangan','nip_kasek_tinjau_lapangan','sekda','petugas_teknis_imb','nip_petugas_teknis_imb','kasie_imb','nip_kasie_imb'
    ];
    protected static $logOnlyDirty = true;
}
