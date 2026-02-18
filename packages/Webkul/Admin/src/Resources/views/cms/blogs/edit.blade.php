<x-admin::layouts>
    <x-slot:title>
        Edit Blog
    </x-slot>

    <x-admin::form
        :action="route('admin.cms.blogs.update', $blog->id)"
        method="PUT"
        enctype="multipart/form-data"
    >
        <div class="flex items-center justify-between">
            <p class="text-xl font-bold text-gray-800 dark:text-white">
                Edit Blog
            </p>

            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">
                    Save Blog
                </button>
            </div>
        </div>

        <div class="mt-3.5 flex gap-2.5 max-xl:flex-wrap">
            <div class="flex flex-col gap-2 flex-1 max-xl:flex-auto">
                <div class="box-shadow relative rounded bg-white p-4 dark:bg-gray-900">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Title
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="title"
                            :value="old('title') ?: $blog->title"
                            rules="required"
                            label="Title"
                            placeholder="Title"
                        />

                        <x-admin::form.control-group.error control-name="title" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Slug
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="slug"
                            :value="old('slug') ?: $blog->slug"
                            rules="required"
                            label="Slug"
                            placeholder="Slug"
                        />

                        <x-admin::form.control-group.error control-name="slug" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Short Description
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="short_description"
                            :value="old('short_description') ?: $blog->short_description"
                            label="Short Description"
                            placeholder="Short Description"
                        />

                        <x-admin::form.control-group.error control-name="short_description" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label class="required">
                            Content
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="content"
                            :value="old('content') ?: $blog->content"
                            rules="required"
                            label="Content"
                            placeholder="Content"
                            :tinymce="true"
                        />

                        <x-admin::form.control-group.error control-name="content" />
                    </x-admin::form.control-group>
                </div>
            </div>

            <div class="flex flex-col gap-2 w-[360px] max-w-full max-sm:w-full">
                <div class="box-shadow relative rounded bg-white p-4 dark:bg-gray-900">
                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Status
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="switch"
                            name="status"
                            :value="1"
                            :checked="(bool) $blog->status"
                            label="Status"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Category
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="category"
                            :value="old('category') ?: $blog->category"
                            label="Category"
                            placeholder="Category"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Image URL
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="image"
                            :value="old('image') ?: $blog->image"
                            label="Image URL"
                            placeholder="Image URL"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Author
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="author"
                            :value="old('author') ?: $blog->author"
                            label="Author"
                            placeholder="Author"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Reading Time (mins)
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="number"
                            name="reading_time"
                            :value="old('reading_time') ?: $blog->reading_time"
                            label="Reading Time"
                            placeholder="Reading Time"
                        />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
