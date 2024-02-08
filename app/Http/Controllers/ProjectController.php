<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Models\File;
use App\Models\Project;
use App\Services\File\FileService;
use App\Traits\ApiResponser;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{
    use ApiResponser;
    public function get(Project $project)
    {
        return $this->successResponse($project->toArray());
    }
    public function create(CreateProjectRequest $request, FileService $fileService)
    {
        // create Project instance
        $project = new Project($request->validated());

        // save avatar
        $avatar = $fileService->save($request['avatar']);
        $project->avatar_file_id = $avatar->id;

        // save ts
        $ts = $fileService->save($request['ts']);
        $project->ts_file_id = $ts->id;

        // save project
        $project->save();

        return $this->successResponse($project->toArray(), null, Response::HTTP_CREATED);
    }
}
