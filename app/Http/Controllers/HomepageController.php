<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;



class HomepageController extends Controller
{

    public function __construct(){

        if(Config::find(1)->active==0)
        {
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages', Page::where('status', 1)->orderBy('order', 'ASC')->get());
        view()->share('categories', Category::where('status', 1)->inRandomOrder()->get());

    }

    public function index(){
        $data['articles']=Article::with('getCategory')->where('status', 1)->whereHas('getCategory', function($query){$query->where('status', 1);})->orderByDesc('created_at')->paginate(10);
        $data['articles']->withPath(url('sayfa'));


        return view('front.homepage',$data);
    }

    public function single($category, $slug){

        $category = Category::whereSlug($category)->first();
        $article = Article::where('slug', $slug)->first();

        if($article == null || $category == null)
        {
            abort(403, 'Sayfa bulunamadı');
        }
        else if(Article::whereCategoryId($category->id)->first())
        {
            $data['article'] = $article;
            $article->increment('hit');
        }
        else
        {
            abort(403, 'Sayfa bulunamadı');
        }


        return view('front.single', $data);
    }

    public function category($slug){
        
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Sayfa bulunamadı');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)->where('status', 1)->orderByDesc('created_at')->paginate(10);
        return view('front.category', $data);

    }

    public function page($slug){

        $page = Page::whereSlug($slug)->first() ?? abort(403, 'sayfa bulunamadı');
        $data['page'] = $page;
        
       return view('front.page', $data);

    }

    public function contact(){
        return view('front.contact');
    }

    public function contactpost(Request $request){

        $rules = ['name'=>'required|min:5', 'email'=>'required|email', 'topic'=>'required', 'message'=>'required|min:10'];
        $validate = Validator::make($request->post(),$rules);

        if($validate->fails()){
            
            return redirect()->route('contact')->withErrors($validate)->withInput();
            //print_r($validate->errors()->first('message'));
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->route('contact')->with('success', 'Mesajınız gönderildi!');
    }
}
