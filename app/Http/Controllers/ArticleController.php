<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\article;
use Doctrine\DBAL\Query\QueryException;
use Request;
use Session;
use Redirect;

class ArticleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$article = article::select('article.id','article.type','article.title','users.name')
		->leftJoin('users','article.user','=','users.id')->paginate(5);
		//echo $article->toSql();
		
		return view('pages.article')->with('article',$article);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		return view('pages.article-add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			$article = new article;

			$article->type = Request::get('jenis');
			$article->title = Request::get('judul');
			$article->author = Request::get('author');
			$article->description = Request::get('description');
			$article->keywords = Request::get('keywords');
			$article->tags = Request::get('tags');
			$article->scontent = Request::get('short');
			$article->content = Request::get('content');
			$article->user = Session::get('user')->id;
			$article->save();
		} catch(QueryException $e){
			return $e->getMessage();
		}

		return Redirect::to('/article');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article  = article::find($id);
		return view('pages.article-edit')->with('article',$article);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try{
			$article = article::find($id);
			$article->type = Request::get('jenis');
			$article->title = Request::get('judul');
			$article->author = Request::get('author');
			$article->description = Request::get('description');
			$article->keywords = Request::get('keywords');
			$article->tags = Request::get('tags');
			$article->scontent = Request::get('short');
			$article->content = Request::get('content');
			$article->user = Session::get('user')->id;
			$article->save();
		} catch(QueryException $e){
			return view()->withErrors($e->getMessage());
		}
		return Redirect::to('/article');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try{
			article::destroy($id);
		} catch(QueryException $e){
			return Redirect::back()->with('error','Gagal dihapus');
		} finally{
			return Redirect::to('/article')->with('message','Data berhasil dihapus');
		}
	}

}
