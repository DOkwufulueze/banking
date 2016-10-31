<div class="form-group{{ $errors->has('authorization_level_id') ? ' has-error' : '' }}">
  <label for="authorization_level_id" class="col-md-4 control-label">Authorization Level</label>

  <div class="col-md-6">
    <select id="authorization_level_id" type="authorization_level_id" class="form-control" name="authorization_level_id" required>
      @foreach ($authorizationLevels as $authorizationLevel)
        <option value="{{ $authorizationLevel['id'] }}" {{ $authorizationLevel->id == $userDetail->authorization_level_id ? 'selected' : '' }}>{{ $authorizationLevel->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('authorization_level_id'))
      <span class="help-block">
        <strong>{{ $errors->first('authorization_level_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
  <label for="user_id" class="col-md-4 control-label">User Name</label>

  <div class="col-md-6">
    <select id="user_id" type="user_id" class="form-control" name="user_id" required {{ $userDetail->id ? 'disabled' : '' }}>
      @foreach ($users as $user)
        <option value="{{ $user['id'] }}" {{ $user->id == $userDetail->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('device_type_id'))
      <span class="help-block">
        <strong>{{ $errors->first('device_type_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('detail_title') ? ' has-error' : '' }}">
  <label for="detail_title" class="col-md-4 control-label">Detail Title</label>

  <div class="col-md-6">
    <input type="text" id="detail_title" type="detail_title" class="form-control" name="detail_title" value="{{ $userDetail->detail_title }}" required>

    @if ($errors->has('detail_title'))
      <span class="help-block">
        <strong>{{ $errors->first('detail_title') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
  <label for="details" class="col-md-4 control-label">Detail Value</label>

  <div class="col-md-6">
    <input type="text" id="details" type="details" class="form-control" name="details" value="{{ $userDetail->details }}" required>

    @if ($errors->has('details'))
      <span class="help-block">
        <strong>{{ $errors->first('details') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      {{ $userDetail->id ? 'Edit User Detail' : 'Create User Detail' }}
    </button>
  </div>
</div>
