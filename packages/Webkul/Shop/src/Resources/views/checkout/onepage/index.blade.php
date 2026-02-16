<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.checkout.onepage.index.checkout')"/>

    <meta name="keywords" content="@lang('shop::app.checkout.onepage.index.checkout')"/>
@endPush

@push('styles')
<style>
    /* THF Checkout Page - Complete Theme Override */

    /* Import Forum Font */
    @import url('https://fonts.googleapis.com/css2?family=Forum&display=swap');

    /* Base */
    * {
        font-family: 'Forum', serif !important;
    }

    body {
        background: #0a0a0a !important;
        min-height: 100vh;
    }

    /* Header */
    .flex.w-full.justify-between.border {
        background: #000 !important;
        border: none !important;
        border-bottom: 1px solid rgba(212, 175, 55, 0.3) !important;
        padding: 15px 40px !important;
    }

    /* Logo Override */
    .flex.min-h-\[30px\] img {
        content: url('{{ asset("thf-assets/images/name-logo.png") }}') !important;
        height: 45px !important;
        width: auto !important;
    }

    /* Main Container */
    .container {
        background: #0a0a0a !important;
        max-width: 1400px !important;
        padding-top: 30px !important;
    }

    /* Typography */
    h1, h2, h3, h4, .text-2xl, .text-3xl, .text-xl, .text-lg {
        color: #d4af37 !important;
        font-weight: 400 !important;
        letter-spacing: 1px !important;
    }

    p, span, .text-sm, .text-xs, .text-base {
        color: rgba(255,255,255,0.8) !important;
    }

    .font-medium {
        color: #fff !important;
    }

    /* Breadcrumbs */
    nav[aria-label="Breadcrumb"] a,
    nav[aria-label="Breadcrumb"] span {
        color: rgba(255,255,255,0.6) !important;
    }

    /* Cards & Containers */
    .rounded-xl, .rounded-lg, .rounded-md, .rounded {
        background: rgba(18, 18, 18, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.15) !important;
        backdrop-filter: blur(10px) !important;
    }

    /* Form Elements */
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="number"],
    input[type="password"],
    textarea,
    select {
        background: rgba(30, 30, 30, 0.9) !important;
        border: 1px solid rgba(212, 175, 55, 0.3) !important;
        color: #fff !important;
        border-radius: 6px !important;
        padding: 10px 14px !important;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #d4af37 !important;
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15) !important;
    }

    input::placeholder, textarea::placeholder {
        color: rgba(255,255,255,0.4) !important;
    }

    /* Labels */
    label {
        color: rgba(255,255,255,0.9) !important;
        font-weight: 400 !important;
    }

    /* Primary Buttons */
    .primary-button,
    button.bg-navyBlue,
    .bg-navyBlue,
    button[type="submit"],
    .rounded-2xl.bg-navyBlue {
        background: linear-gradient(135deg, #d4af37 0%, #b8962e 100%) !important;
        color: #000 !important;
        border: none !important;
        padding: 14px 28px !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase !important;
        transition: all 0.3s ease !important;
        box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3) !important;
    }

    .primary-button:hover,
    .bg-navyBlue:hover,
    button[type="submit"]:hover {
        background: linear-gradient(135deg, #e5c349 0%, #d4af37 100%) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4) !important;
    }

    .primary-button:disabled,
    button[type="submit"]:disabled {
        opacity: 0.6 !important;
        cursor: not-allowed !important;
        transform: none !important;
    }

    /* Secondary Buttons */
    .secondary-button {
        background: transparent !important;
        border: 2px solid rgba(212, 175, 55, 0.5) !important;
        color: #d4af37 !important;
        padding: 12px 24px !important;
        border-radius: 8px !important;
        transition: all 0.3s ease !important;
    }

    .secondary-button:hover {
        background: rgba(212, 175, 55, 0.1) !important;
        border-color: #d4af37 !important;
    }

    /* Links */
    a {
        color: #d4af37 !important;
        text-decoration: none !important;
        transition: all 0.2s !important;
    }

    a:hover {
        color: #e5c349 !important;
    }

    /* Radio Buttons */
    input[type="radio"] {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(212, 175, 55, 0.5) !important;
        border-radius: 50%;
        background: rgba(30, 30, 30, 0.9) !important;
        cursor: pointer;
        position: relative;
        margin-right: 10px;
    }

    input[type="radio"]:checked {
        border-color: #d4af37 !important;
        background: rgba(30, 30, 30, 0.9) !important;
    }

    input[type="radio"]:checked::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #d4af37;
    }

    input[type="radio"]:focus {
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15) !important;
        outline: none !important;
    }

    /* Checkboxes */
    input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid rgba(212, 175, 55, 0.5) !important;
        border-radius: 4px;
        background: rgba(30, 30, 30, 0.9) !important;
        cursor: pointer;
        position: relative;
        margin-right: 10px;
    }

    input[type="checkbox"]:checked {
        border-color: #d4af37 !important;
        background: #d4af37 !important;
    }

    input[type="checkbox"]:checked::before {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #000;
        font-size: 14px;
        font-weight: bold;
    }

    input[type="checkbox"]:focus {
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15) !important;
        outline: none !important;
    }

    /* Shipping Method Cards */
    .cursor-pointer.rounded-xl,
    .cursor-pointer.rounded-lg,
    [class*="cursor-pointer"] {
        background: rgba(25, 25, 25, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.2) !important;
        transition: all 0.3s ease !important;
    }

    .cursor-pointer:hover {
        border-color: rgba(212, 175, 55, 0.5) !important;
        background: rgba(30, 30, 30, 0.95) !important;
    }

    /* Payment Method Cards */
    .payment-method,
    [class*="payment"] {
        background: rgba(25, 25, 25, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.2) !important;
    }

    /* Order Summary Sidebar */
    .sticky {
        background: rgba(18, 18, 18, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.2) !important;
        border-radius: 12px !important;
        padding: 24px !important;
        backdrop-filter: blur(10px) !important;
    }

    /* Summary Items */
    .flex.justify-between {
        padding: 10px 0 !important;
        color: rgba(255,255,255,0.8) !important;
    }

    /* Product Images in Summary */
    .relative img, .product-image img {
        border-radius: 8px !important;
        border: 1px solid rgba(212, 175, 55, 0.2) !important;
    }

    /* Prices */
    .font-semibold {
        color: #d4af37 !important;
    }

    /* Dividers */
    .border-t, .border-b {
        border-color: rgba(212, 175, 55, 0.15) !important;
    }

    /* Icons */
    [class^="icon-"], [class*=" icon-"] {
        color: #d4af37 !important;
    }

    /* Tax Hiding - Safety Layer */
    [class*="tax"]:not([class*="syntax"]),
    .tax-row,
    .tax-amount,
    .tax-summary,
    *[class*="Tax"],
    *[data-tax],
    div:has(> span:contains("Tax")),
    tr:has(> td:contains("Tax")) {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        overflow: hidden !important;
    }

    /* Accordion Headers */
    .accordion-header,
    [class*="accordion"] {
        background: rgba(25, 25, 25, 0.95) !important;
        border: 1px solid rgba(212, 175, 55, 0.2) !important;
        color: #d4af37 !important;
    }

    /* Error Messages */
    .text-red-500, .text-red-600, [class*="text-red"] {
        color: #ff6b6b !important;
    }

    /* Success Messages */
    .text-green-500, .text-green-600, [class*="text-green"] {
        color: #51cf66 !important;
    }

    /* Loading Spinner */
    .spinner, [class*="spinner"] {
        border-color: rgba(212, 175, 55, 0.2) !important;
        border-top-color: #d4af37 !important;
    }

    /* Disabled Elements */
    :disabled, [disabled] {
        opacity: 0.5 !important;
        cursor: not-allowed !important;
    }

    /* Background Overrides */
    .bg-white, .bg-gray-50, .bg-gray-100, .bg-zinc-50, .bg-zinc-100 {
        background: rgba(18, 18, 18, 0.95) !important;
    }

    /* Text Color Overrides */
    .text-zinc-500, .text-gray-500, .text-zinc-600, .text-gray-600 {
        color: rgba(255,255,255,0.6) !important;
    }

    .text-zinc-800, .text-gray-800, .text-zinc-900, .text-gray-900 {
        color: rgba(255,255,255,0.9) !important;
    }

    /* Border Overrides */
    .border-zinc-200, .border-gray-200 {
        border-color: rgba(212, 175, 55, 0.15) !important;
    }

    /* Grid Gap Styling */
    .grid {
        gap: 20px !important;
    }

    /* Shimmer Effect Override */
    .shimmer {
        background: linear-gradient(90deg,
            rgba(30, 30, 30, 0.9) 0%,
            rgba(212, 175, 55, 0.1) 50%,
            rgba(30, 30, 30, 0.9) 100%) !important;
    }
</style>
@endPush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.checkout.onepage.index.checkout')
    </x-slot>

    {!! view_render_event('bagisto.shop.checkout.onepage.header.before') !!}

    <!-- Page Header -->
    <div class="flex-wrap">
        <div class="flex w-full justify-between border border-b border-l-0 border-r-0 border-t-0 px-[60px] py-4 max-lg:px-8 max-sm:px-4">
            <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
                <a
                    href="{{ route('shop.home.index') }}"
                    class="flex min-h-[30px]"
                    aria-label="@lang('shop::checkout.onepage.index.bagisto')"
                >
                    <img
                        src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                        alt="{{ config('app.name') }}"
                        width="131"
                        height="29"
                    >
                </a>
            </div>

            @guest('customer')
                @include('shop::checkout.login')
            @endguest
        </div>
    </div>

    {!! view_render_event('bagisto.shop.checkout.onepage.header.after') !!}

    <!-- Page Content -->
    <div class="container px-[60px] max-lg:px-8 max-sm:px-4">

        {!! view_render_event('bagisto.shop.checkout.onepage.breadcrumbs.before') !!}

        <!-- Breadcrumbs -->
        @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
            <x-shop::breadcrumbs name="checkout" />
        @endif

        {!! view_render_event('bagisto.shop.checkout.onepage.breadcrumbs.after') !!}

        <!-- Checkout Vue Component -->
        <v-checkout>
            <!-- Shimmer Effect -->
            <x-shop::shimmer.checkout.onepage />
        </v-checkout>
    </div>

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-checkout-template"
        >
            <template v-if="! cart">
                <!-- Shimmer Effect -->
                <x-shop::shimmer.checkout.onepage />
            </template>

            <template v-else>
                <div class="grid grid-cols-[1fr_auto] gap-8 max-lg:grid-cols-[1fr] max-md:gap-5">
                    <!-- Included Checkout Summary Blade File For Mobile view -->
                    <div class="hidden max-md:block">
                        @include('shop::checkout.onepage.summary')
                    </div>

                    <div
                        class="overflow-y-auto max-md:grid max-md:gap-4"
                        id="steps-container"
                    >
                        <!-- Included Addresses Blade File -->
                        <template v-if="['address', 'shipping', 'payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.address')
                        </template>

                        <!-- Included Shipping Methods Blade File -->
                        <template v-if="cart.have_stockable_items && ['shipping', 'payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.shipping')
                        </template>

                        <!-- Included Payment Methods Blade File -->
                        <template v-if="['payment', 'review'].includes(currentStep)">
                            @include('shop::checkout.onepage.payment')
                        </template>
                    </div>

                    <!-- Included Checkout Summary Blade File For Desktop view -->
                    <div class="sticky top-8 block h-max w-[442px] max-w-full max-lg:w-auto max-lg:max-w-[442px] ltr:pl-8 max-lg:ltr:pl-0 rtl:pr-8 max-lg:rtl:pr-0">
                        <div class="block max-md:hidden">
                            @include('shop::checkout.onepage.summary')
                        </div>

                        <div
                            class="flex justify-end"
                            v-if="canPlaceOrder"
                        >
                            <template v-if="cart.payment_method == 'paypal_smart_button'">
                                {!! view_render_event('bagisto.shop.checkout.onepage.summary.paypal_smart_button.before') !!}

                                <!-- Paypal Smart Button Vue Component -->
                                <v-paypal-smart-button></v-paypal-smart-button>

                                {!! view_render_event('bagisto.shop.checkout.onepage.summary.paypal_smart_button.after') !!}
                            </template>

                            <template v-else>
                                <x-shop::button
                                    type="button"
                                    class="primary-button w-max rounded-2xl bg-navyBlue px-11 py-3 max-md:mb-4 max-md:w-full max-md:max-w-full max-md:rounded-lg max-sm:py-1.5"
                                    :title="trans('shop::app.checkout.onepage.summary.place-order')"
                                    ::disabled="isPlacingOrder"
                                    ::loading="isPlacingOrder"
                                    @click="placeOrder"
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </script>

        <script type="module">
            app.component('v-checkout', {
                template: '#v-checkout-template',

                data() {
                    return {
                        cart: null,

                        displayTax: {
                            prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",

                            subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",
                            
                            shipping: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_shipping_amount') }}",
                        },

                        isPlacingOrder: false,

                        currentStep: 'address',

                        shippingMethods: null,

                        paymentMethods: null,

                        canPlaceOrder: false,
                    }
                },

                mounted() {
                    this.getCart();
                },

                methods: {
                    getCart() {
                        this.$axios.get("{{ route('shop.checkout.onepage.summary') }}")
                            .then(response => {
                                this.cart = response.data.data;

                                this.scrollToCurrentStep();
                            })
                            .catch(error => {});
                    },

                    stepForward(step) {
                        this.currentStep = step;

                        if (step == 'review') {
                            this.canPlaceOrder = true;

                            return;
                        }

                        this.canPlaceOrder = false;

                        if (this.currentStep == 'shipping') {
                            this.shippingMethods = null;
                        } else if (this.currentStep == 'payment') {
                            this.paymentMethods = null;
                        }
                    },

                    stepProcessed(data) {
                        if (this.currentStep == 'shipping') {
                            this.shippingMethods = data;
                        } else if (this.currentStep == 'payment') {
                            this.paymentMethods = data;
                        }

                        this.getCart();
                    },

                    scrollToCurrentStep() {
                        let container = document.getElementById('steps-container');

                        if (! container) {
                            return;
                        }

                        container.scrollIntoView({
                            behavior: 'smooth',
                            block: 'end'
                        });
                    },

                    placeOrder() {
                        this.isPlacingOrder = true;

                        this.$axios.post('{{ route('shop.checkout.onepage.orders.store') }}')
                            .then(response => {
                                if (response.data.data.redirect) {
                                    window.location.href = response.data.data.redirect_url;
                                } else {
                                    window.location.href = '{{ route('shop.checkout.onepage.success') }}';
                                }

                                this.isPlacingOrder = false;
                            })
                            .catch(error => {
                                this.isPlacingOrder = false

                                this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                            });
                    }
                },
            });
        </script>
    @endPushOnce
</x-shop::layouts>
