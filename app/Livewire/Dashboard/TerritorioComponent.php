<?php

namespace App\Livewire\Dashboard;

use App\Models\Municipio;
use App\Models\Parroquia;
use App\Traits\ToastBootstrap;
use Livewire\Component;

class TerritorioComponent extends Component
{
    use ToastBootstrap;

    public $numero = 7, $tableStyle = false;
    public $limitMunicipios = 0, $limitParroquias = 0;
    public $keywordMunicipios, $keywordParroquias;


    public function mount()
    {
        $this->setLimit();
    }

    public function render()
    {
        $municipios = Municipio::buscar($this->keywordMunicipios)->limit($this->limitMunicipios)->get();
        $rowsMunicipios = Municipio::buscar($this->keywordMunicipios)->count();

        $parroquias = Parroquia::buscar($this->keywordParroquias)->limit($this->limitParroquias)->get();
        $rowsParroquias = Parroquia::buscar($this->keywordParroquias)->count();

        return view('livewire.dashboard.territorio-component')
            ->with('listarMunicipios', $municipios)
            ->with('rowsMunicipios', $rowsMunicipios)
            ->with('listarParroquias', $parroquias)
            ->with('rowsParroquias', $rowsParroquias);
    }

    public function setLimit($all = true)
    {
        /*if (numRowsPaginate() < $this->numero) {
            $rows = $this->numero;
        } else {
            $rows = numRowsPaginate();
        }*/

        $rows = 7;

        if ($all) {
            $this->limitMunicipios = $this->limitMunicipios + $rows;
            $this->limitParroquias = $this->limitParroquias + $rows;
        }else{
            if ($all == 'municipios') {
                $this->limitMunicipios = $this->limitMunicipios + $rows;
            }else{
                $this->limitParroquias = $this->limitParroquias + $rows;
            }
        }
    }

}
