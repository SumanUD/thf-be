<x-admin::layouts>
    <x-slot:title>
        Recipes
    </x-slot>

    <div class="flex items-center justify-between">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            Recipes
        </p>

        <div class="flex items-center gap-x-2.5">
            <a href="{{ route('admin.cms.recipes.create') }}" class="primary-button">
                Create Recipe
            </a>
        </div>
    </div>

    <x-admin::datagrid :src="route('admin.cms.recipes.index')" />

</x-admin::layouts>
