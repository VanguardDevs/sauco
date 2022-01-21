<?php

namespace App\Http\Controllers;

use Illuminate\Http\Liquerclasifications;

class LiquerClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = LiquerClassification::query();
        $results = $Liquerclasifications->perPage;

        if ($Liquerclasifications->has('filter')) {
            $filters = $Liquerclasifications->filter;

            if (array_key_exists('name', $filters)) {
                $query->whereLike('name', $filters['name']);
            }
               
            if (array_key_exists('abbreviature', $filters)) {
                    $query->whereLike('abbreviature', $filters['abbreviature']);
            }
        }

        return $query->paginate($results);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Liquerclasificationsrequest $request)
    {
        $model = liquerclassification::create($Liquerclasifications->all());

        return $model;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Liquerclasifications  $Liquerclasifications,$id)
    {
        return $liquerclassification;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Liquerclasifications  $Liquerclasifications
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LiquerclasificationsRequest $request, Liquerclasifications  $Liquerclasifications)
    {
        $liquerclassification->update($Liquerclasifications->all());

        return $liquerclassification;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liquerclassification $liquerclassification)
    {
        $liquerclassification->delete();

        return $liquerclassification;
    }
}
