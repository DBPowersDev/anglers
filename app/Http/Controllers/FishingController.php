<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fishing;
use App\Models\Picture;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ContainerRequest;
use Intervention\Image\ImageManager;

class FishingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $fishings = Fishing::all();

        $fishings = function () use ($request) {
            $a = $request;
            return Fishing::all();
        };

        return inertia('Fishing/Index', [
            'fishings' => fn() => $fishings()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Fishing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContainerRequest $request)
    {
        $fishing = new Fishing();
        $fishing->fishing_date = $request->fishing_date;
        $fishing->fishing_type = $request->fishing_type;
        $fishing->place = $request->place;
        $fishing->comment = $request->comment;
        $fishing->save();

        // 画像を保存
        $file = $request->validated()['file'];
        $path = $file->store('tmp');
        $image = ImageManager::gd()->read($file);
        $image->scaleDown(width: 800)->save(storage_path('app/' . $path));
        $fmFile = new File(storage_path('app/' . $path));

        $pitcure = new Picture();
        $pitcure->fishing_id = $fishing->id; // 釣行データのIDを紐付け
        $pitcure->picture = $fmFile;
        $pitcure->save();

        return redirect()
            ->route('fishing.index')
            ->with('success', __('Added fishing data.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fishing $fishing)
    {
        // $fishing = Fishing::find($id);
        $modId = $fishing->getModId();
        return redirect()->back()
            ->with([
                'one_data' => $fishing,
                'mod_id' => $modId
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
