<div class="text-center mb-4">
    <h3 class="address-title mb-2">{{ $title ?? "Form Title" }}</h3>
</div>
<form id="modalForm" class="row g-3" action="{{ $actionRoute }}" method="POST">
    @csrf
    @method($actionMethod)

    <div class="col-md-6">
        @include('admin.partials.inputs.input-field', [
       'name' => 'name',
       'value' => isset($item) ? $item?->name : '',
       'label' => 'Name',
       'required' => true,
       'type' => 'text'
        ])
    </div>
    <div class="col-md-6">
        @include('admin.partials.selects.select-field', [
            'name' => 'parent_id',
            'label' => 'Parent Category',
            'required' => false,
            'value' => isset($item) ? $item->parent_id : null,
            'options' => $categories
        ])
    </div>

    <hr class="col-12"/>
    <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
        <button
            type="reset"
            class="btn btn-label-secondary"
            data-bs-dismiss="modal"
            aria-label="Close">
            Cancel
        </button>
    </div>
</form>
