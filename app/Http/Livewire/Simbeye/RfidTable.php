<?php

namespace App\Http\Livewire\Simbeye;

use App\Models\Simbeye;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RfidTable extends DataTableComponent
{
    protected $model = Simbeye::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            // Column::make("Id", "id")->sortable()->searchable(),
            Column::make("Rfid No.", "card_no")->sortable()->searchable(),
            Column::make("Username")->sortable()->searchable(),
            Column::make("Amount")->sortable()->searchable(),
            Column::make("Usage")->sortable()->searchable(),
            Column::make("Last used")->sortable()->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Actions", "id")->view("simbeye.rfid-table-actions"),
        ];
    }
}
