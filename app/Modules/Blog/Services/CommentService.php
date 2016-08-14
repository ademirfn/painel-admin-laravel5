<?php

namespace App\Modules\Blog\Services;

use App\Modules\Blog\Models\Comment;
use Illuminate\Support\Facades\Session;

class CommentService {

    private $comment;    

    function __construct(Comment $comment) 
    {
        $this->comment = $comment;        
    }    

    public function update($request) {  
      
    }

    public function status($comment) {
        $parms['active'] = 'Y';
        if ($comment->active == 'Y') {
            $parms['active'] = 'N';
        }

        $comment->update($parms);

        if (is_null($comment->comment_id)) {
            if (count($comment->children) > 0) {
                foreach ($comment->children as $children) {
                    $children->update(['active' => 'N']);
                }
            }
        }
        Session::flash('success', 'Comentário atualizado com sucesso!');
    }    

}
