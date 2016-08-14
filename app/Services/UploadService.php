<?php

namespace App\Services;

class UploadService {

    public function up($file) {
        $extension = $file->getClientOriginalExtension();
        $name = md5(time()) . '.' . $extension;
        \Storage::disk('public_local')->put($name, \File::get($file));
        return $name;
    }

}
