<?php

namespace App\Http\Controllers;

use App\Models\Packages\Activity;

abstract class Controller
{
    protected string $successMessage = '%s \'%s\' %s successfully.';
    protected string $infoMessage = '';
    protected string $warningMessage = '';
    protected string $errorMessage = '';

    protected function foobar()
    {
        return 'foobar';
    }

    protected function getActivityLogs($subjectId, $subjectType)
    {
        return Activity::query()
            ->with(['created_by'])
            ->where('subject_id', $subjectId)
            ->where('subject_type', $subjectType)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }

    protected function getSuccessMessage($route, $modelName, $recordName, $event)
    {
        return to_route($route)
            ->with('message', sprintf($this->successMessage, class_basename($modelName), $recordName, $event));
    }
}
