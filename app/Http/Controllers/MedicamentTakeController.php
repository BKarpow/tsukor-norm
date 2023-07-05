<?php

namespace App\Http\Controllers;

use App\Models\MedicamentTake;
use App\Http\Requests\StoreMedicamentTakeRequest;
use App\Http\Requests\UpdateMedicamentTakeRequest;
use App\Lib\HistoryServicesTrait;
use App\Models\UserWriteHistory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Lib\ToolTrait;

class MedicamentTakeController extends Controller
{
    use ToolTrait;
    use HistoryServicesTrait;

    private Collection $meds;

    public function __construct()
    {
        $this->middleware('auth');
        $this->meds = new Collection();
    }

    private function initMeds()
    {
        $this->meds = $meds = Auth::user()
                        ->medicaments()
                        ->select('id')
                        ->whereActive(true)
                        ->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('medicamentTake.index', [
            'meds' => Auth::user()->medTake()
            ->orderBy('created_at', 'desc')
            ->paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->initMeds();
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        return view('medicamentTake.create', [
            'medicaments' => $this->meds
        ]);
    }

    private function verifyMedicaments(int $medId)
    {
        $access = false;
        foreach($this->meds as $med) {
            if ($medId === (int)$med->id) {
                $access = true;
                break;
            }
        }
        if (!$access) {
            abort(418);
            dd();
        }
    }

    private function storeOne(array $data): MedicamentTake
    {

        $this->verifyMedicaments((int)$data['med_id']);
        if ($this->isPastDate($data['created_at'])) {
            return redirect()->route('home')->withStatus("Ви не можете додавати показник в майбутньому :(, вибачте!");
        }
        $m = new MedicamentTake();
        $m->user_id = Auth::id();
        $m->med_id = (int)$data['med_id'];
        $m->dose = $this->getCorrectFloatFromString($data['dose']);
        $m->note = $data['note'] ?? "";
        $m->created_at = $data['created_at'];

        $m->save();
        $this->newUserHistryWrite(
            UserWriteHistory::TYPE_MEDICAMENT_TAKE,
            (int)$m->id,
            $data['created_at']
        );
        return $m;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicamentTakeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->initMeds();
        $data = $request->toArray();
        foreach ($data as $item) {
            $this->storeOne($item);
        }

        return response()->json([
            'adds' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function show(MedicamentTake $medicamentTake)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicamentTake $medicamentTake)
    {
        $this->authorize('update', $medicamentTake);
        return view('medicamentTake.update', [
            'medicament' => $medicamentTake,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicamentTakeRequest  $request
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicamentTakeRequest $request, MedicamentTake $medicamentTake)
    {
        $this->authorize('update', $medicamentTake);
        $medicamentTake->dose = $request->dose;
        $medicamentTake->note = $request->note;
        $medicamentTake->created_at = $request->created_at;
        $medicamentTake->save();
        return redirect()
            ->route('home')
            ->withStatus('Прийом ліків оновлено.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicamentTake  $medicamentTake
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicamentTake $medicamentTake)
    {
        $this->authorize('update', $medicamentTake);
        $id = (int)$medicamentTake->id;
        $medicamentTake->delete();
        $this->deleteUserHistryFromWriteId(
            UserWriteHistory::TYPE_MEDICAMENT_TAKE,
            $id,
        );
        return response()->json([
            'status' => true,
            'deletedId' => $id
        ]);

    }
}
