<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\DownloadProjectFileRequest;
use App\Http\Requests\Project\PatchProjectRequest;
use App\Models\Project;
use App\Services\File\FileService;
use App\Services\Zip\ZipService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ProjectController extends Controller
{
    use ApiResponser;

    /**
     * Default zip-file name
     */
    const ZIP_FILE_NAME = "Project_files.zip";

    /**
     * Get the specific project
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function get(Project $project): JsonResponse
    {
        return $this->successResponse($project->toArray());
    }

    /**
     * @param CreateProjectRequest $request
     * @param FileService $fileService
     * @return JsonResponse
     */
    public function create(CreateProjectRequest $request, FileService $fileService): JsonResponse
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

    /**
     * @param Project $project
     * @param FileService $fileService
     * @return JsonResponse
     */
    public function delete(Project $project, FileService $fileService): JsonResponse
    {
        $fileService->delete($project->avatarFile);
        $fileService->delete($project->tsFile);

        $project->delete();

        return $this->successResponse([], null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Project $project
     * @param PatchProjectRequest $request
     * @param FileService $fileService
     * @return JsonResponse
     */
    public function patch(
        Project $project,
        PatchProjectRequest $request,
        FileService $fileService
    ): JsonResponse {
        $project->fill($request->validated());

        if (isset($request['avatar'])) {
            $fileService->delete($project->avatarFile);
            $file = $fileService->save($request['avatar']);
            $project->avatar_file_id = $file->id;
        }

        if (isset($request['ts'])) {
            $fileService->delete($project->tsFile);
            $file = $fileService->save($request['ts']);
            $project->ts_file_id = $file->id;
        }

        $project->save();

        return $this->successResponse([], null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Project $project
     * @param DownloadProjectFileRequest $request
     * @param FileService $fileService
     * @param ZipService $zipService
     * @return BinaryFileResponse|StreamedResponse|null
     */
    public function download(
        Project $project,
        DownloadProjectFileRequest $request,
        FileService $fileService,
        ZipService $zipService
    ): BinaryFileResponse|StreamedResponse|null {
        switch($request->validated('file'))
        {
            case Project::DOWNLOAD_FILE_AVATAR:
                return $fileService->getStream($project->avatarFile);
            case Project::DOWNLOAD_FILE_TS:
                return $fileService->getStream($project->tsFile);
            case Project::DOWNLOAD_FILE_ZIP:
                $zip = $zipService->compress($project->getAllFiles(), self::ZIP_FILE_NAME);
                return response()->download($zip)->deleteFileAfterSend();
        }

        return null;                // TODO: throw Exception ???
    }
}
