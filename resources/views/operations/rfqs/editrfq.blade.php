<form action="{{route('submitrfq')}}" method="POST">

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
 <input type="hidden" name="id" id="id" value="{{ $rfq->id }}">
 <input type="hidden" name="type" id="type" value="edit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
  <br>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" class="pr_id" name="prid" value="{{$rfq->pr_id }}">PR No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prid"></div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">PR Date</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="prdate"></div>
  </div>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">Purpose.</div>
    <div class="col-md-10 tx-left pd-y-10 pd-x-55" id="prpurpose"></div>
  </div>

<hr>

<br>
<h3 class="tx-inverse" id="lbl">REQUEST FOR QUOTATION</h3>
<br>

<div class="row pd-x-55">
    <div class="col-md-4">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters">
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label" id="lbltxt">RFQ Ref No: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 refno" value="{{$rfq->ref_no}}" type="text" name="refno" readonly="" placeholder="PHILGEPS Ref No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-6 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
              <input type="text" class="form-control date" value="{{$rfq->date}}" name="date" placeholder="MM/DD/YYYY">
            </div>
          </div><!-- col-4 -->
          <div class="col-md-12 mg-t--1 mg-md-t-0" id="phil">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">PHILGEPS Ref No: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 phgpsno" type="text" name="phgpsno" value="{{$rfq->philgeps_no}}" placeholder="PHILGEPS Ref No" />
            </div>
          </div><!-- col-4 -->
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label">Supplier: <span class="tx-danger">*</span></label>
              <select class="form-control select2-show-search suppliers" name="supplier" style="width: 100%" data-placeholder="Choose one (with searchbox)" tabindex="-1" aria-hidden="true">
                @foreach($suppliers as $supplier)
                  <option value="{{$supplier->id}}" data-address="{{$supplier->address}}" {{$rfq->supplier_id == $supplier->id ? 'selected': ''}}>{{$supplier->name}}</option>
                @endforeach
              </select>
            </div>
          </div><!-- col-4 -->
          <div class="col-md-12 mg-t--1 mg-md-t-0">
            <div class="form-group mg-md-l--1">
              <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16 address" type="text" name="amountpaid" readonly="" placeholder="Address" />
            </div>
          </div>
          
        </div>

        <div class="form-layout-footer bd pd-20 bd-t-0 paydiv">
             
            </div><!-- form-group -->
    </div>
    <hr>
    <div class="row return">
    <div class="col-md-12 tx-left">
      <button type="submit" class="btn btn-primary">Submit Form</button>
    </div>
  </div>
  </div>
  <div class="col-md-8">
    <table class="table">
  <thead class="thead-colored thead-dark">
    <tr>
      <th class="wd-15p"></th>
      <th class="wd-15p">Stock No.</th>
      <th class="wd-15p">Item</th>
      <th class="wd-15p">Quantity</th>
      <th class="wd-15p">Unit</th>
      <th class="wd-15p">ABC Cost</th>
      <th class="wd-15p">Total</th>
    </tr>
  </thead>
  <tbody id="prlines" class="tx-inverse">
    @foreach($rfqlines as $rfqs)
    <tr>
       <td class="wd-10p"><input type="checkbox" class="itemchkr" data-amount="{{$rfqs->total_cost}}" name="items[a][prline_id]" value="{{$rfqs->prline_id}}"></td>
       <td class="wd-10p">{{$rfqs->id}}</td>
       <td class="wd-10p">{{$rfqs->name}}</td>
       <td class="wd-10p"><input type="hidden" name="items[a][qty]" value="{{$rfqs->qty}}">{{$rfqs->qty}}</td>
       <td class="wd-10p"><input type="hidden" name="items[a][unit]" value="{{$rfqs->unit}}">{{$rfqs->unit}}</td>
       <td class="wd-10p"><input type="hidden" name="items[a][unit_cost]" value="{{$rfqs->unit_cost}}">{{$rfqs->unit_cost}}</td>
       <td class="wd-10p"><input type="hidden" name="items[a][total_cost]" value="{{$rfqs->total_cost}}">{{$rfqs->total_cost}}</td>
     </tr>
    @endforeach
  </tbody>
  <tfoot>
     <tr>
        <td class="tx-right" colspan="6"><b>Grand Total:</b></td>
        <td class="text-right">
            <input type="text" id="totalr" value="{{$rfq->total_amount}}" class="form-control text-right total" name="gtotal" tabindex="-1"  />
        </td>
    </tr>
   </tfoot>
</table>
<div class="row delivery">
  <div class="col-md-12">
     <div class="form-layout form-layout-2">
        <div class="row no-gutters tx-center">
          <div class="col-md-12">
            <div class="form-group">
              <label class="form-control-label">Amount in Words: <span class="tx-danger">*</span></label>
              <input class="form-control tx-16" type="text" readonly="" value="{{$rfq->amount_words}}" name="amountwords" placeholder="Amount in Words" id="amountwordsr" />
            </div>
          </div>
          <br>
          <!-- col-4 -->  
        </div>
      </div>
    </div>
  </div>
  <div class="row return">
    <div class="col-md-12 tx-left">
    </div>
  </div>
</div>

</div>
  </form>
  <script type="text/javascript">
    $(document).on("change", '.itemchkr', function(){
      gettotald();

})

    function gettotald(){
  var total=0;
  $(".itemchkr:checkbox:checked").each(function() {
      total += parseFloat($(this).data('amount'));
console.log(total)
    });
      console.log($('#totalr').val())
    $('#totalr').val(total.toFixed(2));
    
    $("#amountwordsr").val(inWords(total)+"pesos only")

}

  </script>