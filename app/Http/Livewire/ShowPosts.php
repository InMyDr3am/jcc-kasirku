<?php

namespace App\Http\Livewire;
use App\Models\Barang;

use Livewire\Component;

class ShowPosts extends Component
{
    public $search;

    protected $queryString = ['search'=> ['except' => '']];
   
    public $limitPerPage = 10;

    protected $listeners = [
        'post-data' => 'postData'
    ];
   
    public function postData()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $posts = Barang::latest()->paginate($this->limitPerPage);

        if ($this->search !== null) {
            $posts = Barang::where('nama_barang','like', '%' . $this->search . '%')
            ->latest()->paginate($this->limitPerPage);
        }
        $this->emit('postStore');

        return view('livewire.post-data', ['posts' => $posts]);
    }
}
