<?php

namespace App\Traits;

use WireUi\Traits\Actions;

trait WithCheckbox
{
    use Actions;
    /**
     * Selektimi i rreshtave qe do te shfaqen ne tabele
     * @var array
     * @return array
     */
    public  $selectIteams = [];

    /**
     * Selektimi i faqes
     */
    public  $selectPage = false;

    /**
     * Selektimi i të gjitha faqeves
     */
    public  $selectAll = false;

    /**
     * Renditja e rreshtave sipas statusit
     * @param $query vetem elementi 0 ose 1 mund te perdoret
     */
    public  $status = null;

    /**
     * Renditja e rreshtave sipas kategorive
     * @param $query vetem elementi 0 ose 1 mund te perdoret
     */
    public $statusName = null;

    /**
     * Kjo vlen për classe qe deshirojm te perdoret per checkbox
     * @var class
     */
    public $model;

    /**
     * Kjo vlen për një variabël që do të përdoret si search
     * @var string
     */
    public $model_search_name;

    /**
     * Definimi i modelit(Databases)   "user::class"
     * @param class $class
     * @param string $model_search_name Emri i variabël që do të përdoret si search
     * @param string $statusName Emri i variabël që do të përdoret si status(1 ose flase)
     * @return class
     */

    public function setModel($class, String $model_search_name = 'name', String $statusName = null)
    {
        $this->model = $class;
        $this->model_search_name = $model_search_name;
        $this->statusName = $statusName;
    }

    /**
     * Selektimi i të gjitha rreshtave
     */
    public function selectAll()
    {
        $this->selectAll = true;
        $this->selectIteams = $this->model::pluck('id');
    }

    /**
     * Selektimi i të gjitha rreshtave
     */
    public function unSelectAll()
    {
        $this->selectIteams = [];
        $this->blankFild();
    }

    // public function deleteRules(){
    // }

    /**
     * Fshirja e të gjitha rreshtave që jane selektuar
     */
    public function deleteSelectIteams(array $row)
    {

        $this->model::whereIn('id', $row)->delete();
        // dd($row);
        session()->flash('success', ' ' . count($row) . ' column deleted successfully');
        $this->notification()->success('Success', count($row) . ' column deleted successfully');
        $row = [];
        $this->dispatchBrowserEvent('colum-deleted');
        $this->blankFild();
    }

    /**
     * Selektimi i rreshtave qe do te shfaqen vetem në atë faqe
     */

    public function selectAllHere()
    {
        $select =  $this->model::where($this->model_search_name, 'like', '%' . $this->search . '%')
            ->when($this->status, fn ($query, $status) => $query->where($this->statusName, $this->status))
            ->fastPaginate($this->paginate_page)
            ->pluck('id')->map(fn ($id) => (string) $id);
        //push vetem 1 her
        $this->selectIteams = array_unique(array_merge($this->selectIteams, $select->toArray()));
        $this->blankFild();
    }

    /**
     * Selektoj te gjitha rreshtat qe jane ne faqen që janë bërë search
     */
    public function selectAllOnSearch()
    {
        $this->selectIteams = $this->model::where($this->model_search_name, 'like', '%' . $this->search . '%')
            ->when($this->status, fn ($query, $status) => $query->where($this->statusName, $this->status))
            ->pluck('id');

        $this->blankFild();
    }

    /**
     * Renditja e rreshtave sipas statusit
     *
     * @param $status vetem elementi 0 ose 1 mund te perdoret
     */
    public function sortByStatus($status = null)
    {
        $this->resetPage();
        $this->status = $status;
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selectIteams = $this->model::where($this->model_search_name, 'like', '%' . $this->search . '%')
                ->orderBy($this->sortBy, $this->sortDirection)
                ->when($this->status, fn ($query, $status) => $query->where($this->statusName, $this->status))
                ->fastPaginate($this->paginate_page)
                ->pluck('id')->map(fn ($id) => (string) $id);
        } else {
            $this->selectIteams = [];
        }
    }

    /**
     * Restarto numrin e faqeve kur behet serach
     */
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function blankFild()
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }
}
