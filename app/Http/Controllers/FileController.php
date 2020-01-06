<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public static function upload($files){
        $path = $files->store('public/files');
        $filename = explode("/", $path)[2];

        $status = File::create([
            'id_file'        => random_number(3).'_'.substr($files->getClientOriginalName(),0,4),
            'nama_file'      => $filename,
            'nama_file_asli' => $files->getClientOriginalName(),
            'lokasi_file'    => $path,
            'tipe_file'      => $files->getClientMimeType(),
            'ukuran_file'    => $files->getClientSize(),
            'uploaded_by'    => auth()->user()->id,
            'uploaded_ip'    => request()->ip()
        ]);

        return ($status) ? array('status' => 'success', 'id' => $status->id_file) : false;
    }

    public static function deleteFile($id_file)
    {   
        // prepare path
        $path = 'public/storage/files/';
        
        // check is this request is array or not?
        if (is_array($id_file)) :
            $arrayList   = true;
            $getFileData = File::whereIn('id_file', $id_file)->get();
        else:
            $arrayList   = false;
            $getFileData = File::where('id_file', $id_file)->first();
        endif;
        
        // check how to process current data
        if ($arrayList !== true) {
            // file found and successfully deleted
            if (!empty($getFileData) && unlink(base_path($path . $getFileData->nama_file))) :
                $db_delete = $getFileData->delete();
            else:
                $db_delete = false;
            endif;   
        }
        else{
            // loop through data
            foreach ($getFileData as $value) :
                // if success to deleted
                if (unlink(base_path($path . $value->nama_file))) {
                    $db_delete[$value->id_file] = File::where("id_file", $value->id_file)->delete();
                }
                else{
                    $db_delete[$value->id_file] = false;
                }
            endforeach;
        }

        if ($db_delete) :
            $return = array('status' => 'success', 'message' => "File successfully deleted");
        else:
            $return = array('status' => 'error', 'message' => "File failed to delete");
        endif;

        return $return;
    }

    public static function fileDetail($id_file = null, $isJson = false)
    {
        if (empty($id_file)) return false;

        $dataFile = File::where('no',$id_file)->orWhere('id_file', $id_file)->first();

        // if data is found
        if (!empty($dataFile)) :
            // output ajax json?
            if ($isJson == true) {
                $output = array('status' => 'success', 'data' => $dataFile);
                return response()->json($output);
            }
            else{
                return $dataFile;
            }
        else:
            // output ajax json?
            if ($isJson == true) {
                $output = array('status' => 'failed', 'message' => "data not found");
                return response()->json($output);
            }
            else{
                return false;
            }
        endif;
    }
}
