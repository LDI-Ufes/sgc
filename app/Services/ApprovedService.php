<?php

namespace App\Services;

use App\Models\Approved;
use App\Models\ApprovedState;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class ApprovedService
{
    /**
     * Undocumented function
     *
     * @return LengthAwarePaginator
     */
    public function list(): LengthAwarePaginator
    {
        (new Approved)->logListed();

        $query = Approved::with(['approvedState', 'course', 'pole', 'role']);
        $query = $query->AcceptRequest(Approved::$accepted_filters)->filter();
        $query = $query->sortable(['updated_at' => 'desc']);
        $approveds = $query->paginate(10);
        $approveds->withQueryString();

        return $approveds;
    }

    /**
     * Undocumented function
     *
     * @param Approved $approved
     * @return Approved
     */
    public function read(Approved $approved): Approved
    {
        $approved->logFetched($approved);

        return $approved;
    }

    /**
     * Undocumented function
     *
     * @param Approved $approved
     * @return void
     */
    public function delete(Approved $approved): void
    {
        $approved->delete();
    }

    /**
     * Undocumented function
     *
     * @param array $attributes
     * @param Approved $approved
     * @return void
     */
    public function changeState(array $attributes, Approved $approved): void
    {
        $new_state_id = $attributes['states'];
        $approved->approved_state_id = $new_state_id;

        $approved->save();
    }

    /**
     * Undocumented function
     *
     * @param array $attributes
     * @return void
     */
    public function batchStore(array $attributes): void
    {
        DB::transaction(function () use ($attributes) {
            foreach ($attributes['approveds'] as $approved) {
                if (Arr::exists($approved, 'check')) {
                    $approved['approved_state_id'] = ApprovedState::where('name', 'Não contatado')->first()->id;

                    $selectedApproved = new Approved($approved);
                    $selectedApproved->save();
                }
            }
        });
    }
}
