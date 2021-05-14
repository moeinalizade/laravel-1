<?php


namespace App\Http\Controllers\Admin;


// مدل آرتیکل را باید حتما یوز کنیم چون ازش استفاده کردیم
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;





class ArticleController extends Controller
{
    // روت اصلی,form delete
    public function index(){
        return view('admin.articles.index' , [
            'articles' => Article::all()
        ]);
    }


    // برای نمایش دادن فرم 
    public function create(){
        return view('admin.articles.create');
    }


    public function store(){
        $validate_data = Validator::make(request()->all() , [
            'title' => 'required|min:10|max:50',
            'body' => 'required'
        ])->validated();

        Article::create([
            'title' => $validate_data['title'],
            'slug' => $validate_data['title'],
            'body' => $validate_data['body'],
        ]);

        return redirect('/admin/articles/create');
    }



    public function edit($id){
        $article = Article::findOrFail($id);

        return view('admin.articles.edit' , [
            'article' => $article
        ]);
    }


    public function update($id){
        // قدم اول. اعتبار سنجی
        $validate_data = Validator::make(request()->all() , [
            'title' => 'required|min:10|max:50',
            'body' => 'required'
        ])->validated();

        // article قدم دوم. پیدا کردن 
        // Article = صدا زدن مدل یا الکونت آرتیکل هست
        // $article = Article::find($id);

        // ساده شده ی پایینی
        $article = Article::findOrFail($id);

        // اگه آرتیکل خالی بود
        // if(is_null($article)) {
        //     abort(404);
        // }

        // return $article;

        // این فیلد ها رو توی آرتیکل آپدیت می کند
        // $article->update([
        //     'title' => $validate_data['title'],
        //     'slug' => $validate_data['title'],
        //     'body' => $validate_data['body'],
        // ]);

        // ساده شده بالایی
        // $validate_data = آرتیکل و بادی را بر می گرداند
        $article->update($validate_data);


        // return redirect('/admin/articles/create');
        // ریدایرکت به صفحه ی قبل(بجای کد بالایی این را استفاده می کنیم)
        return back();
    }




    public function delete($id){
        // findOrFail => اگه وجود داشت بر می کرداند و اکه نه که خطای 404 را بر می گرداند
        $article = Article::findOrFail($id);

        //delete() => متدی توی مدل ها هست که دیتا ها را حذف می کند
        $article->delete();

        // ریدایرکت به صفحه ی قبل
        return back();
    }

}