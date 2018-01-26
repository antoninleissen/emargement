<?php

namespace App\Http\Controllers\Api;

use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterventionController extends ApiController
{
    protected $parametersOperators = [];
    protected $allowedOrderColumns = ['id'];
    protected $dataValidator = [
        'technician_id' => 'required',
        'pac_id'        => 'required',
        'installation'  => 'required',
        'start_date'    => 'required',
        'stop_date'     => 'required'
    ];
    protected $defaultParametersValue = [];

    /**
     * @return string
     */
    protected function getManagerClassName() {
        return Intervention::class;
    }

    public function getInterventionsByTechnician(Request $request) {
        $account = Auth::user();
        $technicianId = $request->get('techId');

        if ($account->type !== 'admin' && $account->id !== $technicianId) {
            return response('Access denied', 401);
        }

        $manager = $this->getManager();
        $query = $manager->newQuery();

        $query->where('technician_id', $technicianId);

        $results = $query->get();

        return response()->json($results);
    }

}
