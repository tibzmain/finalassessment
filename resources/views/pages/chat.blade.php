
<div class="card chat-message" id="chatBody">
   
  
   
    
</div>

<div>
	<textarea class="form-control mt-2 message-sender" id="inputMessage"  name="message" rows="3" placeholder="Type your message here.."></textarea>
	<input type="hidden" id="receiverId">

   <button type="button" class="btn btn-sm btn-success message-sender" style="float: right !important;" id="btnSend">Send</button>
</div>


<script>

function fetch(){

	let id = $('#receiverId').val();
	 // AJAX
        $.ajax({
              
          url: "{{ URL::to('/') }}/get-message",
          type: "POST",
          data: {
            "_token": "{{ csrf_token() }}",        
            id: id
          },
         
          cache: false,
          success: function(data){
              console.log(data.data);
            
            let count = data.data.length;
            let arr = data.data;
            let html = "";
            $('.list-group-item').removeClass('active-link');
            $('#'+id ).addClass('active-link');
            $('#inputMessage').show();
            $('#chatToHeader').html("Chatting to "+ucwords(data.name));
            $('#inputName').val('');
            $('#receiverId').val(id);
            $('.adding-option').hide();

            for (let i = 0; i < count; i++) {

              if(arr[i]['receiver'] == id ){
                html += `<div class=" pe-2 d-flex justify-content-end mt-1" >
    <span class="p-1" style="background-color: #a1f7cf;  border-radius: 10px">`+arr[i]['messsage']+`</span>
   </div>`;
              }else{
                html += `<div class="ps-2  mt-1" >
    <span class="p-1" style="background-color: #e7e7db; border-radius: 10px">`+arr[i]['messsage']+`</span>
   </div>`;
              }
              
              
            }

            $('#chatBody').html(html);
           
          }

        });

        // END AJAX

}


(function(){
	setInterval(function() {fetch()}, 1000);
	$('.message-sender').hide();
	$(document).on('keyup', '#inputMessage', function(){

		let message = $('#inputMessage').val();

		if(message.trim() != ''){
			$('#btnSend').show();
		}else{
			$('#btnSend').hide();
		}

	})


	$(document).on('click', '#btnSend', function(){

		// alert('he');
		let message = $('#inputMessage').val();
		let id = $('#receiverId').val();


		// AJAX
        $.ajax({
              
          url: "{{ URL::to('/') }}/send-message",
          type: "POST",
          data: {
            "_token": "{{ csrf_token() }}",        
            id: id,
            message: message,
          },
         
          cache: false,
          success: function(data){
              console.log(data.data);
            fetch();
            $('#inputMessage').val('');
            $('#btnSend').hide();
          
           
          }

        });

        // END AJAX
	})

})();
</script>