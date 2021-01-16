@extends('layouts.admin')
@section('content')
<div class="main-card">
    <div class="header">
        {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        <a class="btn-md btn-gray" href="{{ route('admin.users.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>

    <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="body">
            <div class="mb-3">
                <label for="name" class="text-xs required">{{ trans('cruds.user.fields.name') }}</label>

                <div class="form-group">
                    <input type="text" id="name" name="name" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name) }}" required>
                </div>
                @if($errors->has('name'))
                    <p class="invalid-feedback">{{ $errors->first('name') }}</p>
                @endif
                <span class="block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="email" class="text-xs required">{{ trans('cruds.user.fields.email') }}</label>

                <div class="form-group">
                    <input type="email" id="email" name="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email) }}" required>
                </div>
                @if($errors->has('email'))
                    <p class="invalid-feedback">{{ $errors->first('email') }}</p>
                @endif
                <span class="block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="password" class="text-xs required">{{ trans('cruds.user.fields.password') }}</label>

                <div class="form-group">
                    <input type="password" id="password" name="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}">
                </div>
                @if($errors->has('password'))
                    <p class="invalid-feedback">{{ $errors->first('password') }}</p>
                @endif
                <span class="block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="roles" class="text-xs required">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn-sm btn-indigo select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn-sm btn-indigo deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="select2{{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <p class="invalid-feedback">{{ $errors->first('roles') }}</p>
                @endif
                <span class="block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="mb-3">
                <label for="pessoa_id" class="text-xs">{{ trans('cruds.user.fields.pessoa') }}</label>

                <div class="form-group">
                    <select  id="pessoa_id" name="pessoa_id" class="{{ $errors->has('pessoa_id') ? ' is-invalid' : '' }}">
                        <option value="">{{ trans('global.select') }}</option>
                        @php $selected_value = $user->pessoa_id ?? 0; @endphp
                        @foreach($pessoas as $pessoa)
                            <option value="{{$pessoa->id}}" {{($selected_value == $pessoa->id) ? 'selected' : ''}}>{{ $pessoa->nome }}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('pessoa_id'))
                    <p class="invalid-feedback">{{ $errors->first('pessoa_id') }}</p>
                @endif
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
        </div>
    </form>
</div>
@endsection