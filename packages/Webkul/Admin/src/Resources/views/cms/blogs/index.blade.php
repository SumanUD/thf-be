<x-admin::layouts>
    <x-slot:title>
        Blogs
    </x-slot>

    <div class="flex items-center justify-between">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            Blogs
        </p>

        <div class="flex items-center gap-x-2.5">
            <a href="{{ route('admin.cms.blogs.create') }}" class="primary-button">
                Create Blog
            </a>
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.cms.blogs.index')" />

</x-admin::layouts>
