<div class="form-group{{ $errors->has('authorization_level_id') ? ' has-error' : '' }}">
  <label for="authorization_level_id" class="col-md-4 control-label">Authorization Level</label>

  <div class="col-md-6">
    <select id="authorization_level_id" type="authorization_level_id" class="form-control" name="authorization_level_id" required>
      @foreach ($authorizationLevels as $authorizationLevel)
        <option value="{{ $authorizationLevel['id'] }}" {{ $authorizationLevel->id == $bankUser->authorization_level_id ? 'selected' : '' }}>{{ $authorizationLevel->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('authorization_level_id'))
      <span class="help-block">
        <strong>{{ $errors->first('authorization_level_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
  <label for="bank_id" class="col-md-4 control-label">Bank Name</label>

  <div class="col-md-6">
    <select id="bank_id" type="bank_id" class="form-control" name="bank_id" required {{ $bankUser->id ? 'disabled' : '' }}>
      @foreach ($banks as $bank)
        <option value="{{ $bank['id'] }}" {{ $bank->id == $bankUser->bank_id ? 'selected' : '' }}>{{ $bank->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('bank_id'))
      <span class="help-block">
        <strong>{{ $errors->first('bank_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
  <label for="user_id" class="col-md-4 control-label">User Name</label>

  <div class="col-md-6">
    <select id="user_id" type="user_id" class="form-control" name="user_id" required {{ $bankUser->id ? 'disabled' : '' }}>
      @foreach ($users as $user)
        <option value="{{ $user['id'] }}" {{ $user->id == $bankUser->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('user_id'))
      <span class="help-block">
        <strong>{{ $errors->first('user_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('bank_user_type_id') ? ' has-error' : '' }}">
  <label for="bank_user_type_id" class="col-md-4 control-label">User Type</label>

  <div class="col-md-6">
    <select id="bank_user_type_id" type="bank_user_type_id" class="form-control" name="bank_user_type_id" required>
      @foreach ($bankUserTypes as $bankUserType)
        <option value="{{ $bankUserType['id'] }}" {{ $bankUserType->id == $bankUser->bank_user_type_id ? 'selected' : '' }}>{{ $bankUserType->name }}</option>
      @endforeach
    </select>

    @if ($errors->has('bank_user_type_id'))
      <span class="help-block">
        <strong>{{ $errors->first('bank_user_type_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('token') ? ' has-error' : '' }}">
  <label for="token" class="col-md-4 control-label">Token</label>

  <div class="col-md-6">
    <input type="text" class="form-control" name="token" value="{{ $bankUser->token }}" disabled>
    <input type="hidden" id="token" type="token" class="form-control" name="token" value="{{ $bankUser->token }}" required>

    @if ($errors->has('token'))
      <span class="help-block">
        <strong>{{ $errors->first('token') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      {{ $bankUser->id ? 'Edit Bank User' : 'Create Bank User' }}
    </button>
  </div>
</div>
