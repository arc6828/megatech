<div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    <label for="comment" class="control-label">{{ 'Comment' }}</label>
    <textarea class="form-control" rows="5" name="comment" type="textarea" id="comment" >{{ isset($comment->comment) ? $comment->comment : ''}}</textarea>
    {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
</div>
<div class="row">
    <div class="col-4 form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
        <label for="user_id" class="control-label">{{ 'Name' }}</label>
        <input class="form-control d-none" name="user_id" type="number" id="user_id" value="{{ isset($comment->user_id) ? $comment->user_id : Auth::id() }}" >
        
        <input class="form-control" name="user_name" type="text" id="user_name" value="{{ isset($comment->user_id) ? $comment->user_id : Auth::user()->name }}" >
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-4 form-group {{ $errors->has('key') ? 'has-error' : ''}}">
        <label for="key" class="control-label">{{ 'Category' }}</label>
        <input class="form-control" name="key" type="text" id="key" value="{{ isset($comment->key) ? $comment->key : $key }}" >
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-4 form-group {{ $errors->has('value') ? 'has-error' : ''}}">
        <label for="value" class="control-label">{{ 'Value' }}</label>
        <input class="form-control" name="value" type="text" id="value" value="{{ isset($comment->value) ? $comment->value : $value }}" >
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <input class="form-control" name="remark" type="text" id="remark" value="{{ isset($comment->remark) ? $comment->remark : ''}}" >
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
