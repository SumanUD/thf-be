<x-admin::layouts>
    <x-slot:title>
        View Contact Submission
    </x-slot>

    <div class="grid gap-2.5">
        <div class="flex items-center justify-between gap-4 max-sm:flex-wrap">
            <div class="grid gap-1.5">
                <p class="text-xl font-bold leading-6 text-gray-800 dark:text-white">
                    Contact Submission #{{ $contact->id }}
                </p>
            </div>

            <div class="flex items-center gap-x-2.5">
                <a
                    href="{{ route('admin.contacts.index') }}"
                    class="transparent-button hover:bg-gray-200 dark:text-white dark:hover:bg-gray-800"
                >
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
        <div class="flex flex-col gap-2 flex-1 max-xl:flex-auto">
            <div class="box-shadow relative rounded bg-white p-4 dark:bg-gray-900">
                <p class="mb-4 text-base font-semibold text-gray-800 dark:text-white">
                    Message Details
                </p>

                <div class="grid gap-4">
                    <div class="grid gap-1">
                        <p class="text-gray-600 dark:text-gray-300">Name</p>
                        <p class="text-gray-800 dark:text-white font-medium">{{ $contact->name }}</p>
                    </div>

                    <div class="grid gap-1">
                        <p class="text-gray-600 dark:text-gray-300">Email</p>
                        <p class="text-gray-800 dark:text-white font-medium">{{ $contact->email }}</p>
                    </div>

                    <div class="grid gap-1">
                        <p class="text-gray-600 dark:text-gray-300">Phone</p>
                        <p class="text-gray-800 dark:text-white font-medium">{{ $contact->contact ?? 'N/A' }}</p>
                    </div>

                    <div class="grid gap-1">
                        <p class="text-gray-600 dark:text-gray-300">Message</p>
                        <p class="text-gray-800 dark:text-white whitespace-pre-wrap">{{ $contact->message }}</p>
                    </div>

                    <div class="grid gap-1">
                        <p class="text-gray-600 dark:text-gray-300">Submitted At</p>
                        <p class="text-gray-800 dark:text-white font-medium">{{ core()->formatDate($contact->created_at, 'd M Y, h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin::layouts>
