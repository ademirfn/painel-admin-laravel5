<?php

namespace App\Modules\Blog\Services;

use App\Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Session;

/**
 * Description of PostService
 *
 * @author tiago
 */
class PostService {
    
    private $post;
    
    function __construct(Post $post) {
        $this->post = $post;
    }
    
    public function store($request) {
        
        $params = $request->all();
        $params['slug'] = str_slug($params['title']);
               
        $file = $request->file('image');               
        
        $params['image'] = str_slug($params['title']) . '.' . $file->getClientOriginalExtension();
                
        \Storage::disk('public_local')->put($params['image'], \File::get($file));
        
        $post = $this->post->find($this->post->create($params)->id);
        
        //add tags        
        $arrayTagsId = $this->post->getTagsId($request->input('tags')); 
        
        $post->tags()->sync($arrayTagsId); 
        
        Session::flash('success', 'Artigo cadastrado com sucesso.');
    }    
    
    public function update($request) {
        $post = $this->post->find($request->id);
       
        $params = $request->all();
        $params['slug'] = str_slug($params['title']);
        
        if($request->hasFile('image')){         
             
            $file = $request->file('image');  
            $params['image'] = str_slug($params['title']) . '.' . $file->getClientOriginalExtension();
            \Storage::disk('public_local')->put($params['image'], \File::get($file));
            
            if (file_exists('uploads/' . $post->image)){
                \Storage::disk('public_local')->delete($post->image);
            }
        }
       
        $post->update($params);   
        
        //edit tags
        $arrayTagsId = $this->post->getTagsId($request->input('tags')); 
        $post->tags()->sync($arrayTagsId); 
        
        Session::flash('success', 'Artigo atualizado com sucesso.');
    }
    
    public function remove($post) {
        if ($post->tags()){
            Session::flash('danger', 'Artigo não pode ser excluído por ter tags relacionadas.');
            return redirect()->back();
        }
        $post->delete();
        if (file_exists('uploads/' . $post->image)){
            \Storage::disk('public_local')->delete($post->image);
        }
        Session::flash('success', 'Artigo excluído com sucesso.');
    }
    
    public function status($post) {
        $parms['active'] = 'Y';
        if($post->active == 'Y'){
            $parms['active'] =  'N';
        }
        $post->update($parms);
        Session::flash('success', 'Artigo atualizado com sucesso!');
    }
}
