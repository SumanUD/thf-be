<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class ContactSubmissionDataGrid extends DataGrid
{
    /**
     * Index.
     *
     * @var string
     */
    protected $primaryColumn = 'id';

    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('contact_submissions')
            ->addSelect(
                'contact_submissions.id',
                'contact_submissions.name',
                'contact_submissions.email',
                'contact_submissions.contact',
                'contact_submissions.message',
                'contact_submissions.created_at'
            );

        $this->addFilter('id', 'contact_submissions.id');
        $this->addFilter('name', 'contact_submissions.name');
        $this->addFilter('email', 'contact_submissions.email');

        return $queryBuilder;
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => 'ID',
            'type'       => 'integer',
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => 'Name',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'email',
            'label'      => 'Email',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'contact',
            'label'      => 'Phone',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => 'Date',
            'type'       => 'datetime',
            'sortable'   => true,
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'icon'   => 'icon-view',
            'title'  => 'View',
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.contacts.view', $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'icon-delete',
            'title'  => 'Delete',
            'method' => 'DELETE',
            'url'    => function ($row) {
                return route('admin.contacts.delete', $row->id);
            },
        ]);
    }
}
