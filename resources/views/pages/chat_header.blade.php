<div class='ps-2 pe-3 py-4 d-flex justify-content-between'>
       
       <div class="d-flex">
       	
      
      	<img src="/images/default.svg" alt="Logo" class='img-thumbnail rounded-circle'/>
        <span class='header-name ms-2'> {{ ucwords(Auth::user()->fname) }}</span>
        </div>
      <button type="button" class="btn btn-success btn-sm" style="border-radius: 50%; float: right; " data-bs-toggle="modal" data-bs-target="#myModal">
      	<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="12" y1="5" x2="12" y2="19" />
  <line x1="5" y1="12" x2="19" y2="12" />
</svg>
		</button>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Message</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form method="POST" action="/compose-message">
        @csrf
            <select class="form-select" id="selectuser" name="contact">

              @if($contact->count() > 0)
                @foreach($contact as $contact)
                  <option value="{{$contact->id}}"> {{$contact->fname}} </option>
                @endforeach
              @else
                <option selected disabled>No Contact</option>
              @endif
            </select>

            <textarea class="form-control mt-2" id="exampleFormControlTextarea1" name="message" rows="3" placeholder="Type your message here.."></textarea>


            <button type="submit" class="btn btn-sm btn-success " style="float: right !important;">Send</button>
          </form>
      </div>
     


      <!-- Modal footer -->
     
    </div>
  </div>
</div>


<script>
(function(){


    $(document).on('click', '#btnSearch', function(){
      alert('hello')

      let name = $('#inputName').val();
    })

})();
</script>