<div class="action-div">
    @isset($data)
        @isset($edit)
            @if (isset($editPermission) && auth()->user()->can($editPermission))
                <a href="#" data-bs-toggle="modal" data-bs-target="{{ $modalId }}" data-id="{{ $data->id }}"
                    data-href="{{ route($edit, $data) }}" class="edit-icon edit-btn">
                    <i class="fa fa-edit"></i></a>
            @endif
        @endisset

        @isset($delete)
            @if (isset($deletePermission) && auth()->user()->can($deletePermission))
                <a href="#confirmationModal" data-bs-toggle="modal" class="btn delete-confirmation-button"
                    data-id="{{ $data->id }}" data-href="{{ route($delete, $data->id) }}"
                    @if (isset($tableId)) data-table="{{ $tableId }}" @endif>
                    <i class="fa fa-trash"></i>
                </a>
            @endif
        @endisset
    @endisset
</div>
