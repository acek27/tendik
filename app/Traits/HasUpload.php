<?php
/**
 * Created by PhpStorm.
 * User: blegoh
 * Date: 04/10/17
 * Time: 9:37
 */

namespace App\Traits;


trait HasUpload
{
    public function hasFile($file, $locate)
    {
        $path = null;

        if ($file) {
            $filename = uniqid() . '-' . uniqid() . '.' . $file->
                getClientOriginalExtension();
            $path = $file->storeAs(date('Y-m-d') . "/" . $locate, $filename);
        }

        return $path;
    }

    public function showFile($data)
    {
        $file = storage_path('app/' . $data);
        return response()
            ->file($file, [
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
    }
}
