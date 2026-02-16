<x-admin::layouts>
    <x-slot:title>
        Contact Submissions
    </x-slot>

    <div class="flex items-center justify-between">
        <p class="text-xl font-bold text-gray-800 dark:text-white">
            Contact Submissions
        </p>
    </div>

    <x-admin::datagrid :src="route('admin.contacts.index')" />

</x-admin::layouts>
