<?php

namespace App\Http\Controllers;

use App\Models\Cubicle;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use PDF;

class CubicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Cubicle::query()->with('taxpayer', 'item')
            ->orderBy('active', 'DESC');
        $results = $request->perPage;
        $sort = $request->sort;
        $order = $request->order;

        if ($request->has('filter')) {
            $filters = $request->filter;

            if (array_key_exists('taxpayer_id', $filters)) {
                $query->where('taxpayer_id', '=', $filters['taxpayer_id']);
            }
            if (array_key_exists('item_id', $filters)) {
                $query->where('item_id', '=', $filters['item_id']);
            }
            if (array_key_exists('address', $filters)) {
                $query->whereLike('address', $filters['address']);
            }
            if (array_key_exists('active', $filters)) {
                $query->where('active', '=', $filters['active']);
            }
        }

        if ($sort && $order) {
            $query->orderBy($sort, $order);
        }

        if ($request->type == 'pdf') {
            return $this->report($query, $request);
        }

        return $query->paginate($results);
    }

    public function report($query, $request)
    {
        // Prepare pdf
        $models = $query->get();
        $title = $request->has('title') ? $request->title : 'Padrón de cubículos';

        $pdf = PDF::LoadView('pdf.reports.cubicles', compact([
            'models',
            'title'
        ]));

        return $pdf->download();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->cubicles as $cubicle) {
            Cubicle::create([
                'item_id' => $request->item_id,
                'address' => $cubicle['address'],
                'created_by' => Auth::user()->id,
                'taxpayer_id' => $request->taxpayer_id
            ]);
        }

        return response()->json([
            'success' => true,
            'cubiclesCount' => count($request->cubicles)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cubicle  $cubicle
     * @return \Illuminate\Http\Response
     */
    public function show(Cubicle $cubicle)
    {
        return $cubicle->load('taxpayer', 'item');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cubicle  $cubicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cubicle $cubicle)
    {
        $newCubicle = $cubicle->replicate();

        $newCubicle->item_id = $request->item_id;
        $newCubicle->address = $request->address;
        $newCubicle->active = true;
        $newCubicle->save();

        $cubicle->active = false;
        $cubicle->save();

        return $newCubicle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cubicle  $cubicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cubicle $cubicle)
    {
        $cubicle->update([
            'active' => false,
            'disincorporated_at' => Carbon::now()
        ]);

        return $cubicle->load('taxpayer', 'item');
    }
}
