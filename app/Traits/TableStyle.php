<?php

namespace App\Traits;

trait TableStyle
{
    public int $size = 305;
    public int $limit = 0;
    public bool $disabled = true;

    public function setLimit(): void
    {
        $this->limit = $this->limit + numRowsPaginate();
    }

    public function setSize($size): void
    {
        $this->size = $size;
    }

    public function btnVermas($limit, $rows): void
    {
        if ($rows > $limit) {
            $this->disabled = false;
        }else{
            $this->disabled = true;
        }
    }

}
