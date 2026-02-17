<x-admin::layouts>
    <x-slot:title>
        Create Recipe
    </x-slot>

    <x-admin::form
        :action="route('admin.cms.recipes.store')"
        method="POST"
        enctype="multipart/form-data"
    >
        <div class="flex items-center justify-between">
            <p class="text-xl font-bold text-gray-800 dark:text-white">
                Create Recipe
            </p>

            <div class="flex items-center gap-x-2.5">
                <button type="submit" class="primary-button">
                    Save Recipe
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
                            rules="required"
                            label="Slug"
                            placeholder="Slug"
                        />

                        <x-admin::form.control-group.error control-name="slug" />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Description
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="textarea"
                            name="description"
                            label="Description"
                            placeholder="Description"
                        />

                        <x-admin::form.control-group.error control-name="description" />
                    </x-admin::form.control-group>

                    <div class="grid grid-cols-2 gap-4">
                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label>
                                Ingredients (one per line)
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                name="ingredients"
                                label="Ingredients"
                                placeholder="Ingredients"
                                rows="10"
                            />
                        </x-admin::form.control-group>

                        <x-admin::form.control-group>
                            <x-admin::form.control-group.label>
                                Instructions (one per line)
                            </x-admin::form.control-group.label>

                            <x-admin::form.control-group.control
                                type="textarea"
                                name="instructions"
                                label="Instructions"
                                placeholder="Instructions"
                                rows="10"
                            />
                        </x-admin::form.control-group>
                    </div>
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
                            value="1"
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
                            label="Image URL"
                            placeholder="Image URL"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Prep Time
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="prep_time"
                            label="Prep Time"
                            placeholder="Ex: 20 mins"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Cook Time
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="cook_time"
                            label="Cook Time"
                            placeholder="Ex: 30 mins"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Servings
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="servings"
                            label="Servings"
                            placeholder="Ex: 4-6"
                        />
                    </x-admin::form.control-group>

                    <x-admin::form.control-group>
                        <x-admin::form.control-group.label>
                            Difficulty
                        </x-admin::form.control-group.label>

                        <x-admin::form.control-group.control
                            type="text"
                            name="difficulty"
                            label="Difficulty"
                            placeholder="Ex: Easy"
                        />
                    </x-admin::form.control-group>
                </div>
            </div>
        </div>
    </x-admin::form>
</x-admin::layouts>
