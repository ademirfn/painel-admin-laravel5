<?php

namespace App\Services;

use App\Models\Banner;
use App\Services\UploadService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BannerService 
{
    private $banner;
    private $upload;
    
    function __construct(Banner $banner, UploadService $upload) 
    {
        $this->banner = $banner;
        $this->upload = $upload;
    }
    
    public function store($request) 
    {
        $parms['image'] = $this->upload->up($request->file('file'));
        $parms['title'] = $request->title;
        $parms['subtitle'] = $request->subtitle;
        $parms['description'] = $request->description;
        $parms['link'] = $request->link;        
        $parms['active'] = $request->active;     

        $this->banner->create($parms);

        Session::flash('success', 'Banner cadastrado com sucesso!');
    }
    
    public function update($request) 
    {
        $banner = $this->banner->find($request->id);
        
        if($request->hasFile('file')){           
            $parms['image'] = $this->upload->up($request->file('file'));
            if (file_exists('uploads/' . $banner->image)){
                \Storage::disk('public_local')->delete($banner->image);
            }
        }

        $parms['title'] = $request->title;
        $parms['subtitle'] = $request->subtitle;
        $parms['description'] = $request->description;
        $parms['link'] = $request->link;
        $parms['price'] = $request->price;

        $banner->update($parms);

        Session::flash('success', 'Banner atualizado com sucesso!');
    }
    
    public function delete($banner) 
    {
        $banner->delete();

        if (file_exists('uploads/' . $banner->image)){
            \Storage::disk('public_local')->delete($banner->image);
        }

        Session::flash('success', 'Banner excluído com sucesso!');
    }
    
    public function status($banner)
    {
        $parms['active'] = 'Y';
        if ($banner->active == 'Y'){
            $parms['active'] = 'N';
        }

        $banner->update($parms);

        Session::flash('success', 'Registro atualizado com sucesso!');        
    }

}
