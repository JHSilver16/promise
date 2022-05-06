<form action="{{route('submitrfq')}}" method="POST">

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
 <input type="hidden" name="id" id="id" value="{{ $rfq->id }}">
 <input type="hidden" name="type" id="type" value="edit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
  <br>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" class="pr_id" name="prid">PR No.</div>
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
<h3 class="tx-inverse" id="lbl">PURCHASE ORDER</h3>
<br>

<div class="row pd-x-55">
 <div class="col-md-5">
                         <div class="form-layout form-layout-2">
                            <div class="row no-gutters">
                              <div class="col-md-12 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">RFQ No: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 refno" value="k2.ref_no+'" type="text" name="refno" readonly="" placeholder="RFQ No" /><input type="hidden" readonly class="form-control" name="[id]" value="k2.rfq_id+'">
                                </div>
                              </div>
                              <div class="col-md-6 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">PO Ref No: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 refno" value="data[0][b-1]+'" type="text" name="[poref]" readonly="" placeholder="PHILGEPS Ref No" />
                                </div>
                              </div>
                              <div class="col-md-6 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">Date: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control date" name="[date]" placeholder="MM/DD/YYYY">
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group">
                                  <label class="form-control-label">Supplier: <span class="tx-danger">*</span></label>
                                    <input type="text" readonly class="form-control" name="supplier" value="k2.name+'"><input type="hidden" readonly class="form-control" name="[supplier]" value="k2.supplier_id+'">
                                </div>
                              </div>

                              <div class="col-md-12 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16 address" type="text" value="k2.address+'" name="[address]" placeholder="Address" />
                                </div>
                              </div>

                              <div class="col-md-12 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">Fund Cluster: <span class="tx-danger">*</span></label>
                                  <input class="form-control tx-16" type="text" required name="[fund]" placeholder="Fund Cluster" />
                                </div>
                              </div>
                              <div class="col-md-4 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label">ORS/BURS No: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control" required name="[orsno]" placeholder="ORS/BURS No">
                                </div>
                              </div>
                              <div class="col-md-4 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> ORS/BURS Date: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control date" required name="[orsdate]"  placeholder="MM/DD/YYYY">
                                </div>
                              </div>
                              <div class="col-md-4 mg-t--1 mg-md-t-0">
                                <div class="form-group mg-md-l--1">
                                  <label class="form-control-label"> ORS/BURS Amount: <span class="tx-danger">*</span></label>
                                  <input type="text" class="form-control" required name="[orsamount]"  placeholder="ORS/BURS Amount">
                                </div>
                              </div>
                              
                            </div>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <table class="table">
                      <thead class="thead-colored thead-dark">
                        <tr>
                          <th class="wd-15p">Stock No.</th>
                          <th class="wd-15p">Item</th>
                          <th class="wd-15p">Quantity</th>
                          <th class="wd-15p">Unit</th>
                          <th class="wd-15p">Unit Cost</th>
                          <th class="wd-15p">Total</th>
                        </tr>
                      </thead>
                      <tbody id="prlinesk2.rfq_id+'" class="tx-inverse tx-center tbody"></tbody>
                      <tfoot>
                         <tr>
                            <td class="tx-right" colspan="5"><b>Grand Total:</b></td>
                            <td class="text-right">
                                <input type="text" id="totalk2.rfq_id+'" class="form-control text-right total" name="rfq[b+'][gtotal]" tabindex="-1" value=k2.awarded_amount readonly="readonly" />
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
                                  <input class="form-control tx-16" value="inWords(parseFloat(k2.awarded_amount))+'pesos only'" type="text" readonly="" name="rfq[b+'][amountwords]" placeholder="Amount in Words" id="amountwordsk2.rfq_id+'" />
                                </div>
                              </div>
                              <br>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
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