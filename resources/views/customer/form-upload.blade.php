
<div class="card  mt-4">
  <div class="card-body">

    <h2>อัพโหลดเอกสาร</h2>
    <div class="table-responsive">
      <table class="table table-sm table-bordered text-center" id="table">
        <thead>
          <tr>
            <th class="text-center">Document</th>
            <th class="text-center">File name</th>
            <th class="text-center">Upload</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>แผนที่</td>
            <td>
              @if( isset($customer->file_map) )
              <a class="" href="{{ url('/storage') }}/{{ $customer->file_map }}"  target="_blank">
              {{ $customer->file_map }}
              </a>
              @endif
            </td>
            <td>
              <div class="input-group  input-group-sm">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file_map" id="file_map" onchange="var fileName = $(this)[0].files[0].name; $(this).next().text(fileName)"  />
                  <label class="custom-file-label" >Choose file</label>
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <td>ใบรับรองบริษัท	</td>
            <td>
              @if( isset($customer->file_cc) )
              <a class="" href="{{ url('/storage') }}/{{ $customer->file_cc }}"   target="_blank">
              {{ $customer->file_cc }}
              </a>
              @endif
            </td>
            <td>
              <div class="input-group  input-group-sm">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file_cc" id="file_cc" onchange="var fileName = $(this)[0].files[0].name; $(this).next().text(fileName)"  />
                  <label class="custom-file-label" >Choose file</label>
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <td>ใบภพ.20		</td>
            <td>
              @if( isset($customer->file_cv_20) )
              <a class="" href="{{ url('/storage') }}/{{ $customer->file_cv_20 }}"   target="_blank">
                {{ $customer->file_cv_20 }}
              </a>
              @endif
            </td>
            <td>
              <div class="input-group  input-group-sm">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file_cv_20" id="file_cv_20" onchange="var fileName = $(this)[0].files[0].name; $(this).next().text(fileName)"  />
                  <label class="custom-file-label" >Choose file</label>
                </div>
              </div>
            </td>
          </tr>

          <tr>
            <td>ระเบียบวางบิล-รับเช็ค	</td>
            <td>
              @if( isset($customer->file_cheque) )
              <a class="" href="{{ url('/storage') }}/{{ $customer->file_cheque }}"   target="_blank">
                {{ $customer->file_cheque }}
              </a>
              @endif
            </td>
            <td>
              <div class="input-group  input-group-sm">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="file_cheque" id="file_cheque" onchange="var fileName = $(this)[0].files[0].name; $(this).next().text(fileName)" />
                  <label class="custom-file-label" >Choose file</label>
                </div>
              </div>
            </td>
          </tr>
      </tbody>
    </table>
    </div>
  </div>
</div>
