<h6 class="text-muted mb-2">Category Based Attributes</h6>
<hr class="col-12"/>
<div class="row g-3">
    @foreach ($attributes ?? [] as $attribute)
        <div class="col-12 col-md-6">
            @include('admin.partials.inputs.input-field', [
               'name' => "attributes[{$attribute->name}]",
               'value' => isset($item) && !empty($item->attributes[$attribute->name]) ? $item->attributes[$attribute->name] : "",
               'label' => $attribute->name,
               'required' => $attribute->is_required->value,
               'type' => $attribute->type->value
            ])
        </div>
    @endforeach
</div>
