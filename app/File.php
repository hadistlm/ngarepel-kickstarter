<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'no';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_file', 'nama_file', 'nama_file_asli', 'lokasi_file', 'ukuran_file', 'tipe_file', 'uploaded_by', 'uploaded_ip'
    ];
}
