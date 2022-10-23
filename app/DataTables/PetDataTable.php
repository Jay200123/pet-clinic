<?php

namespace App\DataTables;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PetDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        $pets = Pet::with(['customer']); 

        return datatables()
        ->eloquent($pets)
        ->addColumn('action', function($row){
         return "<a href=". route('pets.edit', $row->id)." class=\"btn btn-warning\">Edit</a>
         <form action=". route('pets.destroy', $row->id)." method=\"POST\" >". csrf_field().
         '<input name="_method" type="hidden" value="DELETE">
         <button class="btn btn-danger" type="submit">Delete</button>
         </form>';
 
        })

        ->addColumn('customer', function(Pet $pets){
            return $pets->customer->fname;
        })
 
        ->addColumn('images', function($pets){
         $url = asset("$pets->pet_img");
         return '<img src='.$url.' alt="pet.jpeg" height="80" width="80">';
         
        })
 
        ->rawColumns(['action', 'customer', 'images']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pet $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pet $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pet-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {

        // 'description','pet_name','breed','age','gender','owner_id','pet_img'
        return [

            Column::make('id'),
            Column::make('description'),
            Column::make('pet_name')->title('Pet Name'),
            Column::make('breed'),
            Column::make('age'),
            Column::make('gender'),
            Column::make('customer')->name('customer.fname')->title('Owner Name'),
            Column::make('images'),
            Column::make('action')
            ->exportable(false)
            ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Pet_' . date('YmdHis');
    }
}
