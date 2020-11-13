<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class CategoryController extends BaseController
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
	 */
	public function index()
	{
		$categories = BlogCategory::paginate(15);

		return view('blog.admin.categories.index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View|void
	 */
	public function edit($id)
	{
		$item = BlogCategory::findOrFail($id);
		$list = BlogCategory::all();
		return view('blog.admin.categories.edit', compact('item', 'list'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param BlogCategoryUpdateRequest $request
	 * @param  $id
	 * @return RedirectResponse
	 */
	public function update(BlogCategoryUpdateRequest $request, $id)
	{
//		dd(__METHOD__, $request->all(),$id);

		$item = BlogCategory::find($id);
		if (empty($item)) {
			return back()->withErrors(['msg' => "Запись ненайдена id=[$id]"])->withInput();
		}
		$data = $request->all();
		$res = $item->fill($data)->save();
		if ($res) {
			return redirect()->route('blog.admin.categories.edit', $item->id)->with(['success' => 'Успешно сщхранено']);
		} else {
			return back()->withErrors(['msg' => "Ошибка сохранения id=[$id]"])->withInput();
		}
	}

}
