<?php

namespace App\Http\Controllers\site\faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\CategoryFaq;
use Illuminate\Http\Request;

class faqController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $faq_info = Faq::query()
            ->where('cat_id', 1)
            ->get();

        $faq_category = CategoryFaq::query()
            ->paginate(10);

        return view('site.faq.index', compact('faq_info', 'faq_category'));
    }

    public function get_faqs($cat_id)
    {
        $faq_info = Faq::query()
            ->where('cat_id', $cat_id)
            ->get();

        $faq_category = CategoryFaq::query()
            ->paginate(10);

        return view('site.faq.index', compact('faq_info','faq_category'));
    }

}
