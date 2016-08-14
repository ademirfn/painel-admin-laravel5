<?php

namespace App\Modules\Banners\Controllers;

use App\Modules\Banners\Models\Banner;
use App\Modules\Banners\Requests\BannerRequest;
use App\Http\Controllers\Controller;
use App\Modules\Banners\Services\BannerService;

class BannerController extends Controller
{
    private $banner;
    private $service;

    function __construct(Banner $banner, BannerService $service)
    {
        $this->banner = $banner;
        $this->service = $service;
    }

    public function index()
    {
        $banners = $this->banner->all();
        return view('Banners::banners.index', compact('banners'));
    }

    public function details(Banner $banner)
    {        
        return view('Banners::banners.details', compact('banner'));
    }

    public function create()
    {
        return view('Banners::banners.create');
    }

    public function store(BannerRequest $request)
    { 
        $this->service->store($request);
        return redirect()->back();
    }

    public function edit(Banner $banner)
    {
        return view('Banners::banners.edit', compact('banner'));
    }

    public function update(BannerRequest $request)
    {
        $this->service->update($request);
        return redirect()->back();
    }

    public function remove(Banner $banner)
    {
        $this->service->delete($banner);
        return redirect()->route('banners.index');
    }

    public function status(Banner $banner)
    {
        $this->service->status($banner);
        return redirect()->back();
    }
}
