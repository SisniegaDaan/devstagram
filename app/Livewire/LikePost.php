<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likesCount;

    // Esta función (mount) se ejecuta mediante un trigger, en este caso la variable post
    // que le pasamos mediante el componente...

    // En este caso nos ayudará a revisar si el usuario ya le dio like o no
    // para que de esta forma se establezca el estilo del botón (rojo o vacío).
    public function mount($post) 
    {
        $this->isLiked = $post->checkLike( auth()->user() );
        $this->likesCount = $post->likes->count();
    }

    // Esta función está asignada al componente LikePost de Livewire.
    // Ahorramos un poco de çódigo ya que tenemos las dos condiciones de Like
    // para un mismo botón, dependiento las condiciones dadas.
    public function like()
    {
        if($this->post->checkLike( auth()->user() ))
        {
            $this->post->likes()->where('user_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likesCount--;
        } 
        else 
        {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likesCount++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
