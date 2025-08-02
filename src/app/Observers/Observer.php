<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;

class Observer
{
    /*
     * When you hook into the deleting/deleted event of a model, you can't update that same model's record in the
     * database because Laravel treats it as already being in the process of deletion.
     * Use a direct query instead of $model->update()
     * */
    protected function setDeletedByValue($model): void
    {
        DB::table($model->getTable())
            ->where($model->getKeyName(), $model->getKey())
            ->update([
                'deleted_by' => auth()->user()?->id ?? 1
            ]);
    }
}
