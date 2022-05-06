<form action="{{route('submitabstract')}}" method="POST">

 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
 <input type="hidden" name="type" id="rfqs" value="edit">
 <input type="hidden" name="rfqs" id="rfqs" value="{{implode (',', $abs->toArray())}}">
 <input type="hidden" name="id" id="rfqs" value="{{$prs->id}}">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav2()">&times;</a>
  <br>
<h3 class="tx-inverse ">Abstract of Canvass</h3>
<br>

  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" class="absno" id="" value="{{$prs->ref_no}}" name="absno">Abstract No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55 absno" id="">{{$prs->ref_no}}</div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">PR No.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="priddiv">{{$prs->pr_no}}</div>
  </div>
  <div class="row bd-b tx-14 tx-inverse tx-left">
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55"><input type="hidden" id="prno" value="{{$prs->pr_no}}" name="prid">Date</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" ><input type="text" class="form-control date" name="date" placeholder="MM/DD/YYYY" value="{{$prs->date}}">
            </div>
    <div class="col-md-2 tx-left bg-primary tx-white pd-y-10 pd-x-55">RFQ Nos.</div>
    <div class="col-md-4 tx-left pd-y-10 pd-x-55" id="rfqno"></div>
 
</div>
<hr>



<div class="row pd-x-55">
 
  <div class="col-md-12 bd-b">
    <table class="table table-striped table-bordered">
  <thead class="tx-bold">
    <tr class="tx-16">
      <th class="wd-5p">Stock No.</th>
      <th class="wd-5p">Quantity</th>
      <th class="wd-5p">Unit</th>
      <th class="wd-10p">Item</th>
      <th class="wd-15p tx-center" id="cols" colspan="{{count($abstracts[1])}}">Names of Dealers/Stores and Prices Quoted<br> Click the cell below to select the awarded bidder/s.</th>
    </tr>
     <tr> 
     <th class="wd-5p"></th>
      <th class="wd-5p"></th>
      <th class="wd-5p"></th>
      <th class="wd-10p"></th>  
      @foreach($abstracts[1] as $supplier)          
        <th>{{$supplier->name}}</th>
      @endforeach
      </tr>
    </thead>
    <tbody class="bd"> 
        @foreach($abstracts[0] as $item)
          <tr id="{{'tr'.$item->stockno}}">
            <td>{{$item->stockno}}</td>
            <td>{{$item->qty}}</td>
            <td>{{$item->unit}}</td>
            <td>{{$item->name}}</td>
          

        @foreach($rfqslines as $supplier)
            @if( ($supplier['stockno'] == $item->stockno))
              <td class="{{$supplier['status'] == 'awarded' ? 'clicked' : ''}} tdclick" onclick="tdclick();" data-stock="{{$supplier['stockno']}}" data-item="{{$supplier['name']}}" data-supp="{{$supplier['supplier']}}" data-id="{{$supplier['id']}}" data-rfq="{{$supplier['rfq_id']}}">{{$supplier->total_price}}</td>
            @else
            @endif
        @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<br/>
<div class="row delivery mg-t-20">
  <div class="col-md-12">
     <h6>Based on the above abstract of canvass, it is recommended that the awards be made to:</h6>

     <ul class="list-group tx-left" id="list">
      </ul>
    </div>
  </div>
  <hr>
  <div class="row return">
    <div class="col-md-12 tx-left">
      <button type="submit" class="btn btn-primary returnbtn">Submit RFQ</button>
    </div>
  </div>

</div>
  </form>
  <script type="text/javascript">
    
$(document).on('click', '.tdclick', function(){

  if($('#tr'+$(this).data('stock')+':has(td.clicked)')){
    $('#tr'+$(this).data('stock')+' td.tdclick').removeClass('clicked')
    $(this).addClass('clicked');

  }
  else{
    $(this).addClass('clicked');
  }
  addlist(); 
})

function addlist(){
  var str = '';
  var a = 1;
  $('#list').empty();
  var total = 0;
  $("td.clicked").each(function(){
    console.log($(this).data('supp'))
    var supp = $(this).data('supp');
    var item = $(this).data('item');
    var rfq = $(this).data('rfq');
    var id = $(this).data('id');
    console.log(id);
      str += '<li class="tx-14 tx-inverse bd-b">'+supp+' for items '+item+'</li><input type="hidden" name="abs['+a+'][rfq_id]" value="'+rfq+'"><input type="hidden" name="abs['+a+'][amount]" value="'+$(this).html()+'"><input type="hidden" name="abs['+a+'][id]" value="'+id+'">';
      a++;
      
  })
  $('#list').append(str);
  
}
  </script>