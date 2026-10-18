<?php

use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Projekte')] class extends Component
{
    use WithPagination;

    #[Computed]
    public function projects()
    {
        return Project::with('customer')->orderBy('name')->paginate(15);
    }

    public function delete(int $projectId): void
    {
        Project::findOrFail($projectId)->delete();
    }
};
?>

<div>
    <h1 class="text-2xl font-bold">Projekte</h1>

    <table class="mt-6 w-full overflow-hidden rounded-lg bg-white text-left ring-1 ring-gray-200">
        <thead class="bg-gray-100 text-sm text-gray-600">
            <tr>
                <th class="px-4 py-2">Projekt</th>
                <th class="px-4 py-2">Kunde</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($this->projects as $project)
                <tr wire:key="project-{{ $project->id }}">
                    <td class="px-4 py-2 font-medium">{{ $project->name }}</td>
                    <td class="px-4 py-2">{{ $project->customer->name }}</td>
                    <td class="px-4 py-2">
                        <span class="rounded-full px-2.5 py-0.5 text-xs font-medium {{ $project->status->color() }}">{{ $project->status->label() }}</span>
                    </td>
                    <td class="px-4 py-2 text-right text-sm">
                        <button wire:click="delete({{ $project->id }})" wire:confirm="Projekt «{{ $project->name }}» wirklich löschen?" class="text-red-600 hover:underline">Löschen</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">Keine Projekte vorhanden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $this->projects->links() }}
    </div>
</div>
