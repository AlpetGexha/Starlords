<?php

namespace App\Traits;

trait WithSorting
{
    /**
     * listo nga by defaul id
     * */
    public $sortBy = 'id';

    /**
     * vjetersia e postimit
     */
    public $sortDirection = 'desc';

    /**
     *  Lista Numrave te faqeve (Per page)
     *
     *  @var array
     */
    public $page_numer = [10, 20, 50, 70, 100];

    /**
     *  numri i faqeve (paginate)
     * @var int
     */
    public $paginate_page = 10;

    /**
     * Thema per paginate
     * */
    protected $paginationTheme = 'tailwind';

    /**
     * Rendit nga  "username"
     * @param String $field
     */
    public function sortBy(String $field)
    {
        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';

        $this->sortBy = $field;
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }
}
