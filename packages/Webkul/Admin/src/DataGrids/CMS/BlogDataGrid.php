<?php

namespace Webkul\Admin\DataGrids\CMS;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class BlogDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('blogs')
            ->select(
                'blogs.id',
                'blogs.title',
                'blogs.slug',
                'blogs.category',
                'blogs.status'
            );

        $this->addFilter('id', 'blogs.id');
        $this->addFilter('title', 'blogs.title');
        $this->addFilter('status', 'blogs.status');

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
            'index'      => 'title',
            'label'      => 'Title',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'slug',
            'label'      => 'Slug',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'category',
            'label'      => 'Category',
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => 'Status',
            'type'       => 'boolean',
            'filterable' => true,
            'sortable'   => true,
            'closure'    => function ($row) {
                if ($row->status) {
                    return '<span class="label-active">Active</span>';
                }

                return '<span class="label-canceled">Inactive</span>';
            },
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
            'icon'   => 'icon-edit',
            'title'  => 'Edit',
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.cms.blogs.edit', $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'icon-delete',
            'title'  => 'Delete',
            'method' => 'DELETE',
            'url'    => function ($row) {
                return route('admin.cms.blogs.delete', $row->id);
            },
        ]);
    }
}
