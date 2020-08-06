<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($brand->title) ? $brand->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Content' }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea" id="content" >{{ isset($brand->content) ? $brand->content : ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('begin_date') ? 'has-error' : ''}}">
    <label for="begin_date" class="control-label">{{ 'Begin Date' }}</label>
    <input class="form-control" name="begin_date" type="date" id="begin_date" value="{{ isset($brand->begin_date) ? $brand->begin_date : ''}}" >
    {!! $errors->first('begin_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('deadline') ? 'has-error' : ''}}">
    <label for="deadline" class="control-label">{{ 'Deadline' }}</label>
    <input class="form-control" name="deadline" type="date" id="deadline" value="{{ isset($brand->deadline) ? $brand->deadline : ''}}" >
    {!! $errors->first('deadline', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('complete_date') ? 'has-error' : ''}}">
    <label for="complete_date" class="control-label">{{ 'Complete Date' }}</label>
    <input class="form-control" name="complete_date" type="datetime-local" id="complete_date" value="{{ isset($brand->complete_date) ? $brand->complete_date : ''}}" >
    {!! $errors->first('complete_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('remark') ? 'has-error' : ''}}">
    <label for="remark" class="control-label">{{ 'Remark' }}</label>
    <textarea class="form-control" rows="5" name="remark" type="textarea" id="remark" >{{ isset($brand->remark) ? $brand->remark : ''}}</textarea>
    {!! $errors->first('remark', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <label for="photo" class="control-label">{{ 'Photo' }}</label>
    <input class="form-control" name="photo" type="file" id="photo" value="{{ isset($brand->photo) ? $brand->photo : ''}}" >
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
