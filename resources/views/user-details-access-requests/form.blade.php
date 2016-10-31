<div class="form-group">
  <label for="token" class="col-md-4 control-label">Enter Security Token</label>

  <div class="col-md-6">
    <input type="text" id="token" name="token" class="access-request">
  </div>
</div>

<div class="form-group">
  <label for="bank_id" class="col-md-4 control-label">Select Bank</label>

  <div class="col-md-6">
    <select id="bank_id" class="form-control access-request" name="bank_id" required>
      <option value="">Select Bank</option>
      @foreach ($APIUserBanks as $APIUserBank)
        <option value="{{ $APIUserBank['id'] }}">{{ $APIUserBank->name }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
  <label for="user_id" class="col-md-4 control-label">User Name</label>

  <div class="col-md-6">
    <select id="user_id" type="user_id" class="form-control access-request" name="user_id" required>
      <option value="">Select User</option>
    </select>

    @if ($errors->has('user_id'))
      <span class="help-block">
        <strong>{{ $errors->first('user_id') }}</strong>
      </span>
    @endif
  </div>
</div>

<div class="form-group{{ $errors->has('detail_id') ? ' has-error' : '' }}">
  <label for="detail_id" class="col-md-4 control-label">Detail Title</label>

  <div class="col-md-6">
    <select id="detail_id" type="detail_id" class="form-control access-request" name="detail_id" required>
      <option value="">Select Detail Title</option>
    </select>
  </div>
</div>

<input type="hidden" name="requester_id" id="requester_id" value="{{Auth::user()->id}}" class="access-request">
<input type="hidden" name="authorization_level_id" id="authorization_level_id" class="access-request">

<div class="form-group">
  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      Create User Detail Request
    </button>
  </div>
</div>
