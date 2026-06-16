<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;

class ActivityObserver
{
    protected function write($model, string $event)
    {
        try {
            $user = Auth::user();
            $userId = $user?->id;
            $userName = $user?->name;
            $meta = [
                'model' => get_class($model),
                'attributes' => $model->getAttributes(),
            ];

            ActivityLog::create([
                'user_id' => $userId,
                'action' => strtolower(class_basename($model)) . "_{$event}",
                'meta' => $meta,
                'ip' => request()?->ip(),
            ]);
        } catch (\Throwable $e) {
            Log::error('ActivityObserver error: ' . $e->getMessage());
        }
    }

    public function created($model)
    {
        $this->write($model, 'created');
    }

    public function updated($model)
    {
        $this->write($model, 'updated');
    }

    public function deleted($model)
    {
        $this->write($model, 'deleted');
    }
}
