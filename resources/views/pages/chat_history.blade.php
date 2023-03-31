<div class=' chat-history'>
        <ul class="list-group">

            @if($user->count() > 0)
                  @foreach($user as $user)
                        <li class="list-group-item " data-id="{{$user->id}}" id="{{$user->id}}"> {{ucwords($user->fname) }}  {{ucwords($user->lname) }}</li>
                  
                  @endforeach
            @else
                  <li class="list-group-items"> No Chat History  </li>
            @endif
            </ul>
    </div>


<script>

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

(function(){

  $(document).on('click', '.list-group-item', function(){

    let id = $(this).data('id')

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
  })
})();
</script>