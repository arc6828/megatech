<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control form-control-sm" name="name" type="text" id="name" value="{{ isset($contact->name) ? $contact->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('department') ? 'has-error' : ''}}">
    <label for="department" class="control-label">{{ 'Department' }}</label>
    <select name="department" class="form-control form-control-sm" id="department" >
    @foreach (json_decode('{"เจ้าของธุรกิจ":"เจ้าของธุรกิจ","จัดซื้อ":"จัดซื้อ","Engineer":"Engineer","Store":"Store","Sales":"Sales"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($contact->department) && $contact->department == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
    </select>
    {!! $errors->first('department', '<p class="help-block">:message</p>') !!}
    
</div>
<div class="row">
    <div class="form-group col-lg-12">
        <script>
            function selectAddress(){
                // call api university
                var id = document.getElementById("group_address").value;
                //var school = document.getElementById("school");
                var url = "{{ url('api/customer/') }}"+"/"+id;
                console.log(url);
                var datajson = fetch(url).then(response => response.json())
                .then(data => {
                    console.log(data);
                    //console.log(data.university);
                    switch(id){
                        case "1" : 
                            document.getElementById("address").value = data.address;
                            document.getElementById("province").value = data.province;
                            document.getElementById("district").value = data.district;
                            document.getElementById("tambon").value = data.sub_district;
                            document.getElementById("zipcode").value = data.zipcode;
                            break;
                        case "2" : 
                            document.getElementById("address").value = data.delivery_address;
                            document.getElementById("province").value = data.delivery_province;
                            document.getElementById("district").value = data.delivery_district;
                            document.getElementById("tambon").value = data.delivery_sub_district;
                            document.getElementById("zipcode").value = data.delivery_zipcode;
                            break;                        
                    }
                    //console.log(school);
                    
                });
                }
        </script>
        <select class="form-control form-control-sm" name="group_address" id="group_address" onchange="selectAddress()" >
            <option value="1">ใช้ที่อยู่หลักของบริษัท</option>
            <option value="2">ใช้ที่อยู่ขนส่ง</option>
            <option value="3">กำหนดที่อยู่เอง</option>
        </select>
    </div>
    <div class="form-group col-lg-4">
    <label >สถานที่</label>
    <input type="text" name="address" id="address" class="form-control form-control-sm  " >
    </div>
    <div class="form-group col-lg-2">
    <label >จังหวัด</label>
    <select class="form-control form-control-sm" name="province"  id="province" onchange="showAmphoes('delivery_address')"></select>
    
    </div>
    <div class="form-group col-lg-2">
    <label >อำเภอ</label>
    <select class="form-control form-control-sm"  name="district"  id="district"  onchange="showDistricts('delivery_address')"></select>
    
    </div>
    <div class="form-group col-lg-2">
    <label>ตำบล</label>
    <select class="form-control form-control-sm"  name="sub_district" id="sub_district" onchange="showZipcode('delivery_address')"></select>
    
    </div>
    <div class="form-group col-lg-2">
    <label  >รหัสไปรษณีย์</label>
    <input class="form-control form-control-sm"  name="zipcode"  id="zipcode" placeholder="รหัสไปรษณีย์" />
    
    </div>
    @include('customer/district_script')
</div>


<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control form-control-sm" name="email" type="text" id="email" value="{{ isset($contact->email) ? $contact->email : ''}}" >
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Phone' }}</label>
    <input class="form-control form-control-sm" name="phone" type="text" id="phone" value="{{ isset($contact->phone) ? $contact->phone : ''}}" >
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="row">      
    <div class="form-group col-lg-3 {{ $errors->has('ref_qt') ? 'has-error' : ''}}">
        <label for="ref_qt" class="control-label">
        <input type="checkbox" {{ $contact->ref_qt === "true" ? 'checked' : ''}} onclick="document.querySelector('#ref_qt').value = this.checked"> 
        {{ 'ใบเสนอราคา (QT)' }}
        </label>
        <input class="form-control form-control-sm form-control form-control-sm-sm checklist" name="ref_qt" type="text" id="ref_qt" value="{{ isset($contact->ref_qt) ? $contact->ref_qt : ''}}" >
        {!! $errors->first('ref_qt', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group col-lg-3 {{ $errors->has('ref_iv') ? 'has-error' : ''}} d-none">
        <label for="ref_iv" class="control-label">
        <input type="checkbox" {{ $contact->ref_iv === "true" ? 'checked' : ''}} onclick="document.querySelector('#ref_iv').value = this.checked"> 
        {{ 'ใบขาย (IV)' }}
        </label>
        <input class="form-control form-control-sm form-control form-control-sm-sm checklist" name="ref_iv" type="text" id="ref_iv" value="{{ isset($contact->ref_iv) ? $contact->ref_iv : ''}}" >
        {!! $errors->first('ref_iv', '<p class="help-block">:message</p>') !!}
    </div>    
    <div class="form-group col-lg-3 {{ $errors->has('ref_bi') ? 'has-error' : ''}}">
        <label for="ref_bi" class="control-label">
        <input type="checkbox" {{ $contact->ref_bi === "true" ? 'checked' : ''}} onclick="document.querySelector('#ref_bi').value = this.checked"> 
        {{ 'ใบวางบิล (BI)' }}
        </label>
        <input class="form-control form-control-sm form-control form-control-sm-sm checklist" name="ref_bi" type="text" id="ref_bi" value="{{ isset($contact->ref_bi) ? $contact->ref_bi : ''}}" >
        {!! $errors->first('ref_bi', '<p class="help-block">:message</p>') !!}
    </div> 
    <div class="form-group col-lg-3 {{ $errors->has('ref_po') ? 'has-error' : ''}}">
        <label for="ref_po" class="control-label">
        <input type="checkbox" {{ $contact->ref_po === "true" ? 'checked' : ''}} onclick="document.querySelector('#ref_po').value = this.checked"> 
        {{ 'ใบสั่งซื้อ (PO)' }}
        </label>
        <input class="form-control form-control-sm form-control form-control-sm-sm checklist" name="ref_po" type="text" id="ref_po" value="{{ isset($contact->ref_po) ? $contact->ref_po : ''}}" >
        {!! $errors->first('ref_po', '<p class="help-block">:message</p>') !!}
    </div>
    
    
</div>


<div class="form-group {{ $errors->has('contact_type') ? 'has-error' : ''}}">
    <label for="contact_type" class="control-label">{{ 'Contact Type' }}</label>
    
    @php
        $contact_type = request('customer_id')?'customer':'supplier';
    @endphp
    <input class="form-control form-control-sm" name="contact_type" type="text" id="contact_type" value="{{ isset($contact->contact_type) ? $contact->contact_type : $contact_type }}" readonly>
    
    <select name="" class="form-control form-control-sm d-none" id="" >
    @foreach (json_decode('{"customer":"Customer","supplier":"Supplier"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($contact->contact_type) && $contact->contact_type == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
    </select>
    {!! $errors->first('contact_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    <label for="customer_id" class="control-label">{{ 'Customer Id' }}</label>
    <input class="form-control form-control-sm" name="customer_id" type="text" id="customer_id" value="{{ isset($contact->customer_id) ? $contact->customer_id : request('customer_id') }}"  readonly>
    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    <label for="supplier_id" class="control-label">{{ 'Supplier Id' }}</label>
    <input class="form-control form-control-sm" name="supplier_id" type="text" id="supplier_id" value="{{ isset($contact->supplier_id) ? $contact->supplier_id : request('supplier_id')}}" readonly>
    {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
