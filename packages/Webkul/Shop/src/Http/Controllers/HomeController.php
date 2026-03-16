<?php

namespace Webkul\Shop\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Core\Repositories\ContactSubmissionRepository;
use Webkul\CMS\Repositories\BlogRepository;
use Webkul\CMS\Repositories\RecipeRepository;
use Webkul\Shop\Http\Requests\ContactRequest;
use Webkul\Shop\Http\Resources\CategoryTreeResource;
use Webkul\Shop\Mail\ContactUs;
use Webkul\Theme\Repositories\ThemeCustomizationRepository;

class HomeController extends Controller
{
    /**
     * Using const variable for status
     */
    const STATUS = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected ThemeCustomizationRepository $themeCustomizationRepository, 
        protected CategoryRepository $categoryRepository,
        protected ContactSubmissionRepository $contactSubmissionRepository,
        protected BlogRepository $blogRepository,
        protected RecipeRepository $recipeRepository
    ) {}

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        visitor()->visit();

        $customizations = $this->themeCustomizationRepository->orderBy('sort_order')->findWhere([
            'status'     => self::STATUS,
            'channel_id' => core()->getCurrentChannel()->id,
            'theme_code' => core()->getCurrentChannel()->theme,
        ]);

        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);

        $categories = CategoryTreeResource::collection($categories);

        return view('shop::home.index', compact('customizations', 'categories'));
    }

    /**
     * Loads the home page for the storefront if something wrong.
     *
     * @return \Exception
     */
    public function notFound()
    {
        abort(404);
    }

    /**
     * Summary of contact.
     *
     * @return \Illuminate\View\View
     */
    public function contactUs()
    {
        return view('shop::home.contact-us');
    }

    /**
     * Summary of store.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendContactUsMail(ContactRequest $contactRequest)
    {
        try {
            $data = $contactRequest->only([
                'name',
                'email',
                'contact',
                'message',
            ]);

            $this->contactSubmissionRepository->create($data);

            Mail::queue(new ContactUs($data));

            session()->flash('success', trans('shop::app.home.thanks-for-contact'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            report($e);
        }

        return back();
    }

    /**
     * Store locator page.
     *
     * @return \Illuminate\View\View
     */
    public function storeLocator()
    {
        return view('shop::team.index');
    }

    public function team()
    {
        return view('shop::team.index');
    }

    /**
     * FAQ page.
     *
     * @return \Illuminate\View\View
     */
    public function faq()
    {
        return view('shop::faq.faq-index');
    }

/**
 * FAQ page.
 *
 * @return \Illuminate\View\View
 */
    public function contact()
    {
        return view('shop::contact.contact-index');
    }


    
/**
 * Career page.
 *
 * @return \Illuminate\View\View
 */
    public function career()
    {
        return view('shop::career.career-index');
    }

    /**
 * Blogs page.
 *
 * @return \Illuminate\View\View
 */
    public function blogs()
    {
        return view('shop::insights.blogs');
    }

    /**
     * Single Blog page.
     *
     * @return \Illuminate\View\View
     */
    public function blogView($slug)
    {
        $blog = $this->blogRepository->findOneByField('slug', $slug);

        if (! $blog) {
            abort(404);
        }

        return view('shop::insights.blog-view', compact('blog'));
    }

    /**
 * Recepie page.
 *
 * @return \Illuminate\View\View
 */
    public function recepie()
    {
        return view('shop::insights.recepie');
    }

    /**
     * Single Recipe page.
     *
     * @return \Illuminate\View\View
     */
    public function recipeView($slug)
    {
        $recipe = $this->recipeRepository->findOneByField('slug', $slug);

        if (! $recipe) {
            abort(404);
        }

        return view('shop::insights.recipe-view', compact('recipe'));
    }


    /**
     * Corporate gifting page.
     *
     * @return \Illuminate\View\View
     */
    public function corporate()
    {
        return view('shop::corporate.index');
    }

    /**
     * Collection/Category page.
     *
     * @return \Illuminate\View\View
     */
    public function collection()
    {
        return view('shop::collection.index');
    }

    /**
     * Baklava category page.
     *
     * @return \Illuminate\View\View
     */
    public function baklava()
    {
        return view('shop::categories.baklava');
    }

    /**
     * Labon category page.
     *
     * @return \Illuminate\View\View
     */
    public function labon()
    {
        return view('shop::categories.labon');
    }

    /**
     * Dates category page.
     *
     * @return \Illuminate\View\View
     */
    public function dates()
    {
        return view('shop::categories.dates');
    }

    /**
     * Mewabite category page.
     *
     * @return \Illuminate\View\View
     */
    public function mewabite()
    {
        return view('shop::categories.mewabite');
    }

    /**
     * Assorted collection category page.
     *
     * @return \Illuminate\View\View
     */
    public function assorted()
    {
        return view('shop::categories.assorted');
    }

    /**
     * Specialty Coffee & Espresso Bar page.
     *
     * @return \Illuminate\View\View
     */
    public function specialtyCoffee()
    {
        return view('shop::pages.specialty-coffee');
    }

    /**
     * Healthy Café Food page.
     *
     * @return \Illuminate\View\View
     */
    public function healthyFood()
    {
        return view('shop::pages.healthy-food');
    }

    /**
     * Brand Story page.
     *
     * @return \Illuminate\View\View
     */
    public function brandStory()
    {
        return view('shop::pages.brand-story');
    }



}
