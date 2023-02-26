<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchIndexGkuciseRequest;
use App\Http\Requests\SortedIndexGlucoseRequest;
use App\Models\IndexGlucose;
use App\Http\Requests\StoreIndexGlucoseRequest;
use App\Http\Requests\UpdateIndexGlucoseRequest;
use App\Http\Resources\IGResource;
use Fresh\Transliteration\UkrainianToLatin;

class IndexGlucoseController extends Controller
{

    /**
     * Paginate items in page
     */
    private int $perPage = 35;


    /**
     * Фільтрує аліас імені продукту
     * @param string $nameFood
     * @return string
     */
    private function getAlias(string $nameFood):string
    {
        $nameFood = trim($nameFood);
        $nameFood = mb_strtolower($nameFood);
        $nameFood = preg_replace("#[^\w\d\s]+#u", "", $nameFood);
        $nameFood = preg_replace("#\s+#u", " ", $nameFood);
        return $nameFood;
    }

    /**
     * Транслітератор для url
     * @param string $nameFood
     * @return string
     */
    private function getTrans(string $nameFood):string
    {
        $textLatin = UkrainianToLatin::transliterate($nameFood);
        $textLatin = trim($textLatin);
        $textLatin = preg_replace("#\s+#si", "_", $textLatin);
        $textLatin = mb_strtolower($textLatin);
        $textLatin = preg_replace("#[^\w\d\_]+#si", "", $textLatin);
        return $textLatin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ig.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ig.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIndexGlucoseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndexGlucoseRequest $request)
    {
        $oneHo = 0;
        if ($request->calories != 0){
            $oneHo = round((100 / ($request->carbohydrates  / 11) ), 1);
        }
        $ig = new IndexGlucose();
        $ig->food = $request->food;
        $ig->alias = $this->getAlias($request->food);
        $ig->url = $this->getTrans($request->food);
        $ig->ig = $request->ig;
        $ig->one_ho_count = $oneHo;
        $ig->one_ho_unit = "г.";
        $ig->protein = $request->protein;
        $ig->fats = $request->fats;
        $ig->carbohydrates = $request->carbohydrates;
        $ig->calories = $request->calories;
        $ig->description_food = $request->description_food;
        $ig->public = true;
        $ig->save();
        return redirect()->back()->withStatus('Додано, але цей запис має пройти модерацію!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IndexGlucose  $indexGlucose
     * @return \Illuminate\Http\Response
     */
    public function show(IndexGlucose $indexGlucose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndexGlucose  $indexGlucose
     * @return \Illuminate\Http\Response
     */
    public function edit(IndexGlucose $indexGlucose)
    {
        $this->authorize('update', $indexGlucose);
        return view('ig.update', ['ig' => $indexGlucose]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIndexGlucoseRequest  $request
     * @param  \App\Models\IndexGlucose  $indexGlucose
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIndexGlucoseRequest $request, IndexGlucose $indexGlucose)
    {
        $this->authorize('update', $indexGlucose);
        $indexGlucose->food = $request->food;
        $indexGlucose->alias = $this->getAlias($request->food);
        $indexGlucose->url = $this->getTrans($request->food);
        $indexGlucose->ig = $request->ig;
        $indexGlucose->one_ho_count = $request->one_ho_count;
        $indexGlucose->one_ho_unit = $request->one_ho_unit;
        $indexGlucose->protein = $request->protein;
        $indexGlucose->fats = $request->fats;
        $indexGlucose->carbohydrates = $request->carbohydrates;
        $indexGlucose->calories = $request->calories;
        $indexGlucose->description_food = $request->description_food;
        // TODO Вимкнути цю можливість при продакшені
        $indexGlucose->public = true;
        $indexGlucose->save();
        return redirect()->back()->withStatus('Збережено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndexGlucose  $indexGlucose
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndexGlucose $indexGlucose)
    {
        $this->authorize('update', $indexGlucose);
    }

    public function allListApi()
    {
        return IGResource::collection(
            IndexGlucose::wherePublic(true)->orderBy('ig', 'asc')->paginate($this->perPage)
        );
    }


    /**
     * Пошук по назві продукту через апі
     * @param string $searchText
     */
    public function search(SearchIndexGkuciseRequest $request)
    {
        $se = $this->getAlias($request->search);
        return IGResource::collection(
            IndexGlucose::where('alias', 'LIKE', "%$se%")
                        ->wherePublic(true)
                        ->paginate($this->perPage)
        );
    }


    /**
     * Сортування через апі
     * @param SortedIndexGlucoseRequest $request
     * @return IGResource
     */
    public function sortedApi(SortedIndexGlucoseRequest $request)
    {
        return IGResource::collection(
            IndexGlucose::where('ig', '>=', $request->minIg)
                        ->where('ig', '<=', $request->maxIg)
                        ->wherePublic(true)
                        ->orderBy('ig', 'asc')
                        ->paginate(35)
        );
    }

}
