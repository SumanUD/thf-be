<!-- SEO Meta Content -->
@push('meta')
    <meta
        name="description"
        content="{{ trim($category->meta_description) != "" ? $category->meta_description : \Illuminate\Support\Str::limit(strip_tags($category->description), 120, '') }}"
    />

    <meta
        name="keywords"
        content="{{ $category->meta_keywords }}"
    />

    @if (core()->getConfigData('catalog.rich_snippets.categories.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getCategoryJsonLd($category) !!}
        </script>
    @endif
@endPush

@push('styles')
<style>
    /* THF Category Page - Dark Theme */
    @import url('https://fonts.googleapis.com/css2?family=Forum&display=swap');

    * {
        font-family: 'Forum', serif !important;
    }

    body {
        background: #0a0a0a !important;
        color: rgba(255,255,255,0.9) !important;
    }

    /* Container */
    .container {
        background: #0a0a0a !important;
    }

    /* Category Title & Description */
    h1, h2, h3, .text-2xl, .text-3xl {
        color: #d4af37 !important;
        font-weight: 400 !important;
        letter-spacing: 1px !important;
    }

    p, span, .text-sm, .text-xs {
        color: rgba(255,255,255,0.8) !important;
    }

    /* Product Grid Cards */
    .grid.grid-cols-3 > div,
    .grid.grid-cols-4 > div {
        background: rgba(18, 18, 18, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.15) !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        transition: all 0.3s ease !important;
        max-width: 100% !important;
    }

    .grid.grid-cols-3 > div:hover,
    .grid.grid-cols-4 > div:hover {
        transform: translateY(-5px) !important;
        border-color: rgba(212, 175, 55, 0.4) !important;
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2) !important;
    }

    /* Product Card Links */
    .grid a {
        color: inherit !important;
        text-decoration: none !important;
        display: block !important;
    }

    /* Product Images */
    .grid img {
        width: 100% !important;
        height: auto !important;
        max-height: 300px !important;
        object-fit: cover !important;
        border-radius: 8px 8px 0 0 !important;
        border: none !important;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2) !important;
    }

    /* Product Names */
    .grid .font-medium {
        color: #fff !important;
        font-size: 1.1rem !important;
    }

    /* Prices */
    .grid .font-semibold {
        color: #d4af37 !important;
        font-size: 1.15rem !important;
    }

    /* Buttons */
    button, .btn, [class*="button"] {
        background: linear-gradient(135deg, #d4af37 0%, #b8962e 100%) !important;
        color: #000 !important;
        border: none !important;
        padding: 10px 20px !important;
        border-radius: 6px !important;
        transition: all 0.3s ease !important;
    }

    button:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4) !important;
    }

    /* Filters Sidebar */
    .max-lg\:gap-5 > div:first-child {
        background: rgba(18, 18, 18, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.2) !important;
        border-radius: 12px !important;
        padding: 20px !important;
    }

    /* Filter Headings */
    .max-lg\:gap-5 h3, .max-lg\:gap-5 h4 {
        color: #d4af37 !important;
    }

    /* Checkboxes & Radio Buttons */
    input[type="checkbox"], input[type="radio"] {
        accent-color: #d4af37 !important;
    }

    /* Pagination */
    .pagination a, .pagination span {
        background: rgba(18, 18, 18, 0.95) !important;
        color: #d4af37 !important;
        border: 1px solid rgba(212, 175, 55, 0.3) !important;
    }

    .pagination a:hover {
        background: rgba(212, 175, 55, 0.2) !important;
    }

    /* Toolbar */
    .max-md\:hidden > div {
        background: rgba(18, 18, 18, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.15) !important;
        border-radius: 8px !important;
        padding: 15px !important;
    }

    /* Select Dropdowns */
    select {
        background: rgba(30, 30, 30, 0.9) !important;
        border: 1px solid rgba(212, 175, 55, 0.3) !important;
        color: #fff !important;
        border-radius: 6px !important;
    }

    /* Empty State */
    .flex-col.items-center p {
        color: rgba(255,255,255,0.7) !important;
    }

    /* Links */
    a {
        color: #d4af37 !important;
        transition: all 0.2s !important;
    }

    a:hover {
        color: #e5c349 !important;
    }

    /* Wishlist & Cart Icons */
    [class^="icon-"], [class*=" icon-"] {
        color: #d4af37 !important;
    }

    /* Background Overrides */
    .bg-white, .bg-gray-50, .bg-zinc-50 {
        background: rgba(18, 18, 18, 0.95) !important;
    }

    /* Border Overrides */
    .border-zinc-200, .border-gray-200 {
        border-color: rgba(212, 175, 55, 0.15) !important;
    }

    /* Text Color Overrides */
    .text-zinc-500, .text-gray-500 {
        color: rgba(255,255,255,0.6) !important;
    }

    .text-zinc-900, .text-gray-900 {
        color: rgba(255,255,255,0.9) !important;
    }

    /* Prevent card link from blocking buttons */
    .grid button {
        position: relative !important;
        z-index: 10 !important;
    }
</style>
@endPush

@push('scripts')
<script>
    // Prevent card links from interfering with buttons
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('click', function(e) {
            // If clicking a button inside a card link, prevent navigation
            if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
                const button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
                const cardLink = button.closest('a[href*="product"]');
                if (cardLink) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }
        }, true);
    });
</script>
@endPush

<x-shop::layouts>
    <!-- Page Title -->
    <x-slot:title>
        {{ trim($category->meta_title) != "" ? $category->meta_title : $category->name }}
    </x-slot>

    {!! view_render_event('bagisto.shop.categories.view.banner_path.before') !!}

    <!-- Hero Image -->
    @if ($category->banner_path)
        <div class="container mt-8 px-[60px] max-lg:px-8 max-md:mt-4 max-md:px-4">
            <x-shop::media.images.lazy
                class="aspect-[4/1] max-h-full max-w-full rounded-xl"
                src="{{ $category->banner_url }}"
                alt="{{ $category->name }}"
                width="1320"
                height="300"
            />
        </div>
    @endif

    {!! view_render_event('bagisto.shop.categories.view.banner_path.after') !!}

    {!! view_render_event('bagisto.shop.categories.view.description.before') !!}

    @if (in_array($category->display_mode, [null, 'description_only', 'products_and_description']))
        @if ($category->description)
            <div class="container mt-[34px] px-[60px] max-lg:px-8 max-md:mt-4 max-md:px-4 max-md:text-sm max-sm:text-xs">
                {!! $category->description !!}
            </div>
        @endif
    @endif

    {!! view_render_event('bagisto.shop.categories.view.description.after') !!}

    @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))
        <!-- Category Vue Component -->
        <v-category>
            <!-- Category Shimmer Effect -->
            <x-shop::shimmer.categories.view />
        </v-category>
    @endif

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-category-template"
        >
            <div class="container px-[60px] max-lg:px-8 max-md:px-4">
                <div class="flex items-start gap-10 max-lg:gap-5 md:mt-10">
                    <!-- Product Listing Filters -->
                    @include('shop::categories.filters')

                    <!-- Product Listing Container -->
                    <div class="flex-1">
                        <!-- Desktop Product Listing Toolbar -->
                        <div class="max-md:hidden">
                            @include('shop::categories.toolbar')
                        </div>

                        <!-- Product List Card Container -->
                        <div
                            class="mt-8 grid grid-cols-1 gap-6"
                            v-if="(filters.toolbar.applied.mode ?? filters.toolbar.default.mode) === 'list'"
                        >
                            <!-- Product Card Shimmer Effect -->
                            <template v-if="isLoading">
                                <x-shop::shimmer.products.cards.list count="12" />
                            </template>

                            <!-- Product Card Listing -->
                            {!! view_render_event('bagisto.shop.categories.view.list.product_card.before') !!}

                            <template v-else>
                                <template v-if="products.length">
                                    <x-shop::products.card
                                        ::mode="'list'"
                                        v-for="product in products"
                                    />
                                </template>

                                <!-- Empty Products Container -->
                                <template v-else>
                                    <div class="m-auto grid w-full place-content-center items-center justify-items-center py-32 text-center">
                                        <img
                                            class="max-md:h-[100px] max-md:w-[100px]"
                                            src="{{ bagisto_asset('images/thank-you.png') }}"
                                            alt="@lang('shop::app.categories.view.empty')"
                                            loading="lazy"
                                            decoding="async"
                                        />

                                        <p
                                            class="text-xl max-md:text-sm"
                                            role="heading"
                                        >
                                            @lang('shop::app.categories.view.empty')
                                        </p>
                                    </div>
                                </template>
                            </template>

                            {!! view_render_event('bagisto.shop.categories.view.list.product_card.after') !!}
                        </div>

                        <!-- Product Grid Card Container -->
                        <div v-else class="mt-8 max-md:mt-5">
                            <!-- Product Card Shimmer Effect -->
                            <template v-if="isLoading">
                                <div class="grid grid-cols-3 gap-8 max-1060:grid-cols-2 max-md:justify-items-center max-md:gap-x-4">
                                    <x-shop::shimmer.products.cards.grid count="12" />
                                </div>
                            </template>

                            {!! view_render_event('bagisto.shop.categories.view.grid.product_card.before') !!}

                            <!-- Product Card Listing -->
                            <template v-else>
                                <template v-if="products.length">
                                    <div class="grid grid-cols-3 gap-8 max-1060:grid-cols-2 max-md:justify-items-center max-md:gap-x-4">
                                        <x-shop::products.card
                                            ::mode="'grid'"
                                            v-for="product in products"
                                        />
                                    </div>
                                </template>

                                <!-- Empty Products Container -->
                                <template v-else>
                                    <div class="m-auto grid w-full place-content-center items-center justify-items-center py-32 text-center">
                                        <img
                                            class="max-md:h-[100px] max-md:w-[100px]"
                                            src="{{ bagisto_asset('images/thank-you.png') }}"
                                            alt="@lang('shop::app.categories.view.empty')"
                                            loading="lazy"
                                            decoding="async"
                                        />

                                        <p
                                            class="text-xl max-md:text-sm"
                                            role="heading"
                                        >
                                            @lang('shop::app.categories.view.empty')
                                        </p>
                                    </div>
                                </template>
                            </template>

                            {!! view_render_event('bagisto.shop.categories.view.grid.product_card.after') !!}
                        </div>

                        {!! view_render_event('bagisto.shop.categories.view.load_more_button.before') !!}

                        <!-- Load More Button -->
                        <button
                            class="secondary-button mx-auto mt-14 block w-max rounded-2xl px-11 py-3 text-center text-base max-md:rounded-lg max-sm:mt-6 max-sm:px-6 max-sm:py-1.5 max-sm:text-sm"
                            @click="loadMoreProducts"
                            v-if="links.next && ! loader"
                        >
                            @lang('shop::app.categories.view.load-more')
                        </button>

                        <button
                            v-else-if="links.next"
                            class="secondary-button mx-auto mt-14 block w-max rounded-2xl px-[74.5px] py-3.5 text-center text-base max-md:rounded-lg max-md:py-3 max-sm:mt-6 max-sm:px-[50.8px] max-sm:py-1.5"
                        >
                            <!-- Spinner -->
                            <img
                                class="h-5 w-5 animate-spin text-navyBlue"
                                src="{{ bagisto_asset('images/spinner.svg') }}"
                                alt="Loading"
                            />
                        </button>

                        {!! view_render_event('bagisto.shop.categories.view.grid.load_more_button.after') !!}
                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-category', {
                template: '#v-category-template',

                data() {
                    return {
                        isMobile: window.innerWidth <= 767,

                        isLoading: true,

                        isDrawerActive: {
                            toolbar: false,

                            filter: false,
                        },

                        filters: {
                            toolbar: {
                                default: {},

                                applied: {},
                            },

                            filter: {},
                        },

                        products: [],

                        links: {},

                        loader: false,
                    }
                },

                computed: {
                    queryParams() {
                        let queryParams = Object.assign({}, this.filters.filter, this.filters.toolbar.applied);

                        return this.removeJsonEmptyValues(queryParams);
                    },

                    queryString() {
                        return this.jsonToQueryString(this.queryParams);
                    },
                },

                watch: {
                    queryParams() {
                        this.getProducts();
                    },

                    queryString() {
                        window.history.pushState({}, '', '?' + this.queryString);
                    },
                },

                methods: {
                    setFilters(type, filters) {
                        this.filters[type] = filters;
                    },

                    clearFilters(type, filters) {
                        this.filters[type] = {};
                    },

                    getProducts() {
                        this.isDrawerActive = {
                            toolbar: false,

                            filter: false,
                        };

                        document.body.style.overflow ='scroll';

                        this.isLoading = true;

                        this.$axios.get("{{ route('shop.api.products.index', ['category_id' => $category->id]) }}", {
                            params: this.queryParams
                        })
                            .then(response => {
                                this.isLoading = false;

                                this.products = response.data.data;

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                    },

                    loadMoreProducts() {
                        if (! this.links.next) {
                            return;
                        }

                        this.loader = true;

                        this.$axios.get(this.links.next)
                            .then(response => {
                                this.loader = false;

                                this.products = [...this.products, ...response.data.data];

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                    },

                    removeJsonEmptyValues(params) {
                        Object.keys(params).forEach(function (key) {
                            if ((! params[key] && params[key] !== undefined)) {
                                delete params[key];
                            }

                            if (Array.isArray(params[key])) {
                                params[key] = params[key].join(',');
                            }
                        });

                        return params;
                    },

                    jsonToQueryString(params) {
                        let parameters = new URLSearchParams();

                        for (const key in params) {
                            parameters.append(key, params[key]);
                        }

                        return parameters.toString();
                    }
                },
            });
        </script>
    @endPushOnce
</x-shop::layouts>
