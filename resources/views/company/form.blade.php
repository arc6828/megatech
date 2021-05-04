<div class="form-group {{ $errors->has('thname_company') ? 'has-error' : ''}}">
    <label for="thname_company" class="control-label">{{ 'Thname Company' }}</label>
    <input class="form-control" name="thname_company" type="text" id="thname_company" value="{{ isset($company->thname_company) ? $company->thname_company : ''}}" >
    {!! $errors->first('thname_company', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('enname_company') ? 'has-error' : ''}}">
    <label for="enname_company" class="control-label">{{ 'Enname Company' }}</label>
    <input class="form-control" name="enname_company" type="text" id="enname_company" value="{{ isset($company->enname_company) ? $company->enname_company : ''}}" >
    {!! $errors->first('enname_company', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Address' }}</label>
    <textarea class="form-control" rows="5" name="address" type="textarea" id="address" >{{ isset($company->address) ? $company->address : ''}}</textarea>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('tal') ? 'has-error' : ''}}">
    <label for="tal" class="control-label">{{ 'Tal' }}</label>
    <input class="form-control" name="tal" type="number" id="tal" value="{{ isset($company->tal) ? $company->tal : ''}}" >
    {!! $errors->first('tal', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('fax') ? 'has-error' : ''}}">
    <label for="fax" class="control-label">{{ 'Fax' }}</label>
    <input class="form-control" name="fax" type="number" id="fax" value="{{ isset($company->fax) ? $company->fax : ''}}" >
    {!! $errors->first('fax', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('number_tex') ? 'has-error' : ''}}">
    <label for="number_tex" class="control-label">{{ 'Number Tex' }}</label>
    <input class="form-control" name="number_tex" type="number" id="number_tex" value="{{ isset($company->number_tex) ? $company->number_tex : ''}}" >
    {!! $errors->first('number_tex', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ isset($company->image) ? $company->image : ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ isset($company->email) ? $company->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
