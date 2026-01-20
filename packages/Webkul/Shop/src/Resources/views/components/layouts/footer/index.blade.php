{!! view_render_event('bagisto.shop.layout.footer.before') !!}

<!--
    The category repository is injected directly here because there is no way
    to retrieve it from the view composer, as this is an anonymous component.
-->
@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

<!--
    This code needs to be refactored to reduce the amount of PHP in the Blade
    template as much as possible.
-->
@php
    $channel = core()->getCurrentChannel();

    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'theme_code' => $channel->theme,
        'channel_id' => $channel->id,
    ]);
@endphp

<footer class="thf-footer-wrapper mt-9 bg-thfBlack max-sm:mt-10">
    <div class="thf-footer-main flex justify-between gap-x-6 gap-y-8 p-[60px] max-1060:flex-col-reverse max-md:gap-5 max-md:p-8 max-sm:px-4 max-sm:py-5">

        <!-- THF Company Info Section -->
        <div class="thf-footer-brand flex flex-col gap-4 max-w-[350px]">
            <h3 class="text-thfGold font-forum text-xl font-medium tracking-wide mb-2">
                The HazleNut Factory
            </h3>
            <p class="text-white/70 text-sm leading-relaxed font-century">
                Premium handcrafted sweets and treats for discerning clients.
                Elevating relationships through thoughtful gifting since 2010.
            </p>

            <!-- Social Links -->
            <div class="flex gap-3 mt-4">
                <a href="#" class="thf-social-link w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/80 hover:bg-thfGold hover:text-black hover:border-thfGold transition-all duration-300" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="thf-social-link w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/80 hover:bg-thfGold hover:text-black hover:border-thfGold transition-all duration-300" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="thf-social-link w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/80 hover:bg-thfGold hover:text-black hover:border-thfGold transition-all duration-300" aria-label="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="thf-social-link w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/80 hover:bg-thfGold hover:text-black hover:border-thfGold transition-all duration-300" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>

        <!-- For Desktop View - Footer Links -->
        <div class="flex flex-wrap items-start gap-24 max-1180:gap-6 max-1060:hidden">
            @if ($customization?->options)
                @foreach ($customization->options as $footerLinkSection)
                    <ul class="grid gap-4 text-sm">
                        @php
                            usort($footerLinkSection, function ($a, $b) {
                                return $a['sort_order'] - $b['sort_order'];
                            });
                        @endphp

                        @foreach ($footerLinkSection as $index => $link)
                            @if ($index === 0)
                                <li class="mb-2">
                                    <span class="text-thfGold font-forum text-base font-medium tracking-wide">
                                        {{ $link['title'] }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $link['url'] }}" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">
                                        {{ $link['title'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endforeach
            @else
                <!-- Default THF Footer Links -->
                <ul class="grid gap-4 text-sm">
                    <li class="mb-2">
                        <span class="text-thfGold font-forum text-base font-medium tracking-wide">Quick Links</span>
                    </li>
                    <li><a href="{{ route('shop.home.index') }}" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Home</a></li>
                    <li><a href="{{ route('shop.search.index') }}" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Shop</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">About Us</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Contact</a></li>
                </ul>

                <ul class="grid gap-4 text-sm">
                    <li class="mb-2">
                        <span class="text-thfGold font-forum text-base font-medium tracking-wide">Our Products</span>
                    </li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Baklavas</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Labons</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Mewabites</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Royal Dates</a></li>
                </ul>

                <ul class="grid gap-4 text-sm">
                    <li class="mb-2">
                        <span class="text-thfGold font-forum text-base font-medium tracking-wide">Corporate</span>
                    </li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Bulk Orders</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Custom Branding</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Corporate Gifting</a></li>
                    <li><a href="#" class="text-white/70 hover:text-thfGold transition-colors duration-300 font-century">Festive Hampers</a></li>
                </ul>
            @endif
        </div>

        <!-- For Mobile view -->
        <x-shop::accordion
            :is-active="false"
            class="hidden !w-full rounded-xl !border !border-white/20 max-1060:block max-sm:rounded-lg"
        >
            <x-slot:header class="rounded-t-lg bg-white/5 font-medium text-white max-md:p-2.5 max-sm:px-3 max-sm:py-2 max-sm:text-sm">
                @lang('shop::app.components.layouts.footer.footer-content')
            </x-slot>

            <x-slot:content class="flex justify-between !bg-transparent !p-4">
                @if ($customization?->options)
                    @foreach ($customization->options as $footerLinkSection)
                        <ul class="grid gap-4 text-sm">
                            @php
                                usort($footerLinkSection, function ($a, $b) {
                                    return $a['sort_order'] - $b['sort_order'];
                                });
                            @endphp

                            @foreach ($footerLinkSection as $link)
                                <li>
                                    <a
                                        href="{{ $link['url'] }}"
                                        class="text-sm font-medium text-white/70 hover:text-thfGold max-sm:text-xs">
                                        {{ $link['title'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                @endif
            </x-slot>
        </x-shop::accordion>

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.before') !!}

        <!-- News Letter subscription -->
        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
            <div class="grid gap-2.5">
                <p
                    class="max-w-[288px] text-2xl italic leading-[36px] text-thfGold font-forum max-md:text-xl max-sm:text-lg"
                    role="heading"
                    aria-level="2"
                >
                    @lang('shop::app.components.layouts.footer.newsletter-text')
                </p>

                <p class="text-xs text-white/60 font-century">
                    @lang('shop::app.components.layouts.footer.subscribe-stay-touch')
                </p>

                <div>
                    <x-shop::form
                        :action="route('shop.subscription.store')"
                        class="mt-2.5 rounded max-sm:mt-0"
                    >
                        <div class="relative w-full">
                            <x-shop::form.control-group.control
                                type="email"
                                class="block w-[420px] max-w-full rounded-xl border border-white/20 bg-white/5 px-5 py-4 text-base text-white placeholder-white/50 max-1060:w-full max-md:p-3.5 max-sm:mb-0 max-sm:rounded-lg max-sm:border max-sm:p-2 max-sm:text-sm"
                                name="email"
                                rules="required|email"
                                label="Email"
                                :aria-label="trans('shop::app.components.layouts.footer.email')"
                                placeholder="email@example.com"
                            />

                            <x-shop::form.control-group.error control-name="email" />

                            <button
                                type="submit"
                                class="absolute top-1.5 flex w-max items-center rounded-xl bg-thfGold px-7 py-2.5 font-medium text-black hover:bg-[#c9a033] transition-colors max-md:top-1 max-md:px-5 max-md:text-xs max-sm:mt-0 max-sm:rounded-lg max-sm:px-4 max-sm:py-2 ltr:right-2 rtl:left-2"
                            >
                                @lang('shop::app.components.layouts.footer.subscribe')
                            </button>
                        </div>
                    </x-shop::form>
                </div>
            </div>
        @endif

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}
    </div>

    <!-- Contact Info Section -->
    <div class="thf-footer-contact border-t border-white/10 px-[60px] py-8 max-md:px-8 max-sm:px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-sm text-white/70">
            <div class="flex items-center gap-3">
                <i class="fas fa-map-marker-alt text-thfGold"></i>
                <span class="font-century">Corporate Office, Mumbai, India</span>
            </div>
            <div class="flex items-center gap-3">
                <i class="fas fa-phone text-thfGold"></i>
                <span class="font-century">+91 98765 43210</span>
            </div>
            <div class="flex items-center gap-3">
                <i class="fas fa-envelope text-thfGold"></i>
                <span class="font-century">info@thehazlenutfactory.com</span>
            </div>
            <div class="flex items-center gap-3">
                <i class="fas fa-clock text-thfGold"></i>
                <span class="font-century">Mon-Sat: 9AM - 7PM</span>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="flex justify-between items-center border-t border-white/10 bg-black/50 px-[60px] py-4 max-md:flex-col max-md:gap-2 max-md:justify-center max-sm:px-5">
        {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}

        <p class="text-sm text-white/50 font-century max-md:text-center">
            &copy; {{ date('Y') }} The HazleNut Factory. All rights reserved.
        </p>

        <div class="flex gap-4 text-sm text-white/50">
            <a href="#" class="hover:text-thfGold transition-colors font-century">Privacy Policy</a>
            <span>|</span>
            <a href="#" class="hover:text-thfGold transition-colors font-century">Terms of Service</a>
        </div>

        {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}
    </div>
</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}
