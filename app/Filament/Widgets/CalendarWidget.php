<?php

namespace App\Filament\Widgets;

use Illuminate\Database\Eloquent\Builder;
use Guava\Calendar\Filament\CalendarWidget as BaseCalendarWidget;
use Guava\Calendar\ValueObjects\CalendarEvent;
use Guava\Calendar\ValueObjects\FetchInfo;
use Guava\Calendar\ValueObjects\DateClickInfo;
use Illuminate\Support\Collection;
use App\Models\Task;

class CalendarWidget extends BaseCalendarWidget
{
    protected ?string $locale = 'ja';
    protected bool $dateClickEnabled = true;
    protected bool $eventClickEnabled = true;
    protected ?string $defaultEventClickAction = 'view';

    /**
     * イベントを返す
     */
    protected function getEvents(FetchInfo $info): Collection | array | Builder
    {
        return Task::query()
            ->whereBetween('due_date', [$info->start, $info->end])
            ->get()
            ->map(fn ($task) => 
                CalendarEvent::make($task)
                    ->title($task->title)
                    ->start($task->due_date)
                    ->end($task->due_date)
            );
    }

    protected function getEventClickContextMenuActions(): array
    {
        return [
            //$this->viewAction(),
            //$this->editAction(),
            //$this->deleteAction(),
        ];
    }
}
