<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    protected $teamService;
    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    //Add Member Function
    public function store(TeamRequest $teamRequest)
    {
        return $this->teamService->addMember($teamRequest->all());
    }

    //Update Member Function
    public function update(Team $member, Request $request)
    {
        $teamRequest = new TeamRequest();
        $rules = $teamRequest->rules();
        $messages = method_exists($teamRequest, 'messages') ? $teamRequest->messages() : [];

        unset($rules['image']);

        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages
        );

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'status' => false,
                    'errors' => $validator->errors()->all()
                ], 422)
            );
        }

        return $this->teamService->updateMember($member, $request->all());
    }

    //Delete Member Function
    public function destroy (Team $member){
        return $this->teamService->deleteMember($member);
    }

    //Get Members Function
    public function view (Request $request){
        return $this->teamService->getMembers($request->search);
    }

    //Get Member Function
    public function show (Team $member){
        return $this->teamService->getMember($member);
    }
}
