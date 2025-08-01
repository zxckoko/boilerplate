<?php

namespace App\Http\Controllers;

use App\Models\Packages\Activity;

abstract class Controller
{
    protected $successMessage = '%s \'%s\' %s successfully.';
    protected $infoMessage = '';
    protected $warningMessage = '';
    protected $errorMessage = '';

    public function foobar()
    {
        return 'foobar';
    }

    public function getActivityLogs($subjectId, $subjectType)
    {
        return Activity::query()
            ->with(['created_by'])
            ->where('subject_id', $subjectId)
            ->where('subject_type', $subjectType)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }
}
