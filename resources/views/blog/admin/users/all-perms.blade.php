@php
    /** @var  App\Models\Permission $permission **/
@endphp
<h5>Права</h5>
<div class="form-group d-flex flex-wrap">
    @php
        /** @var App\Models\User $user */
        $perms = $user->permissions->keyBy('id')->keys()->toArray();
        if (old('perms')) $perms = old('perms');
    @endphp

    @foreach ($allperms as $permission)
        @php
            /** @var  App\Models\Permission $permission **/
               $checked = in_array($permission->id, $perms)
        @endphp
        <div class="form-check-inline w-25 mr-0">
            <input class="form-check-input" type="checkbox"
                   name="perms[]" id="perm-id-{{ $permission->id }}"
                   value="{{ $permission->id }}" @if($checked) checked @endif>

            <label class="form-check-label" for="perm-id-{{ $permission->id }}">
                {{ $permission->name }}
            </label>
        </div>
    @endforeach
</div>
