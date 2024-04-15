<div class="text-center mb-4">
    <h3 class="address-title mb-2">{{ $title ?? "Form Title" }}</h3>
</div>
<form id="modalForm" class="row g-3" action="{{ $actionRoute }}" method="POST">
    @csrf
    @method($actionMethod)
    <div class="col-md-6">
        @include('admin.partials.selects.select-field', [
            'name' => 'category_id',
            'label' => 'Category',
            'required' => false,
            'value' => isset($item) ? $item->category_id : null,
            'options' => $categories
        ])
    </div>
    <div class="col-12 col-md-6">
        @include('admin.partials.inputs.input-field', [
       'name' => 'name',
       'value' => isset($item) ? $item?->name : '',
       'label' => 'Name',
       'required' => true,
       'type' => 'text'
        ])
    </div>
    <div class="col-md-6">
        @include('admin.partials.selects.enum-select-field', [
            'name' => 'type',
            'label' => 'Type',
            'required' => true,
            'value' => isset($item) ? $item->type : null,
            'options' => \App\Enums\AttributeTypeEnum::cases()
        ])
    </div>
    <div class="col-md-6">
        @include('admin.partials.selects.enum-select-field', [
            'name' => 'is_required',
            'label' => 'Required',
            'required' => true,
            'value' => isset($item) ? $item->is_required : null,
            'options' => \App\Enums\BooleanEnum::cases()
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
