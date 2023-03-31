@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" >
            <div class="card px-2 py-3" >
                <span>
                    
                
                <a href="/home"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="5" y1="12" x2="19" y2="12" />
  <line x1="5" y1="12" x2="9" y2="16" />
  <line x1="5" y1="12" x2="9" y2="8" />
</svg>
               </a>
               </span>

               <div class="input-group mb-3">
          <input type="text" id="inputName" class="form-control" placeholder="Search name" aria-label="Search Name" aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary" type="button" id="btnSearch"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="10" cy="10" r="7" />
  <line x1="21" y1="21" x2="15" y2="15" />
</svg>
</button>
        </div>

            <span class="adding-option" id="errorNotif">No match found</span>
            <select class="form-select adding-option" id="selectuser">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>

            <button type="button" class="btn btn-sm btn-primary adding-option mt-2" style="float: right !important;" id="btnAdd">Add</button>

                <h5>Contact List</h5>
                <section id="notifContact">  <center > <span >No Contact</span></center> </section>

            <section id="contactList">

                

               
              
            </section>



            </div>

        
        </div>
    </div>
</div>



<script>

function fetchtable(){

     // AJAX
        $.ajax({
              
          url: "{{ URL::to('/') }}/fetch-contact",
          type: "POST",
          data: {
            "_token": "{{ csrf_token() }}",        
        
          },
         
          cache: false,
          success: function(data){
              console.log(data.data);
           
                let count = data.data.length
                let arr = data.data;
                let section = "";
                if(count > 0 ){
                    $('#notifContact').hide();

                    for (let i = 0; i < count; i++) {

                        section += `<section class="fs-5 ms-5 "> <img src="/images/default.svg">`+ucwords(arr[i]['fname'])+" "+ ucwords(arr[i]['lname'])+` <a href="#" class="ms-3 btn-delete-contact" data-id="${arr[i]['id']}" onclick="return confirm('Are you sure you want to delete this ?')"> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <line x1="4" y1="7" x2="20" y2="7" />
  <line x1="10" y1="11" x2="10" y2="17" />
  <line x1="14" y1="11" x2="14" y2="17" />
  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
</svg></a> </section>`
                    }


                    $('#contactList').html(section)
                }else{
                    $('#contactList').html('')
                    $('#notifContact').show();
                }
          }

        });

        // END AJAX

}

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}


(function(){

    fetchtable();
    $('.adding-option').hide(); 
    $('#notifContact').hide(); 

    $(document).on('click', '.btn-delete-contact', function(){

        let id = $(this).data('id');

        // AJAX
        $.ajax({
              
          url: "{{ URL::to('/') }}/delete-contact",
          type: "POST",
          data: {
            "_token": "{{ csrf_token() }}",        
            id: id
          },
         
          cache: false,
          success: function(data){
              console.log(data.data);
           
                
            if(parseInt(data.data) > 0 ){
                fetchtable();
            }else{

            }
           
          }

        });

        // END AJAX

       

    })
    $(document).on('click', '#btnAdd', function(){
        // alert('hello')
        let id = $('#selectuser').val();

        // AJAX
        $.ajax({
              
          url: "{{ URL::to('/') }}/add-user",
          type: "POST",
          data: {
            "_token": "{{ csrf_token() }}",        
            id: id
          },
         
          cache: false,
          success: function(data){
              console.log(data.data);
           
            fetchtable();
            $('#inputName').val('');
              $('.adding-option').hide();
           
          }

        });

        // END AJAX

     
    })


    $(document).on('click', '#btnSearch', function(){
      // alert('hello')

      let name = $('#inputName').val();

      console.log(name)

      if(name == ''){

      }else{
        // AJAX
        $.ajax({
              
          url: "{{ URL::to('/') }}/search-user",
          type: "POST",
          data: {
            "_token": "{{ csrf_token() }}",        
            name: name
          },
         
          cache: false,
          success: function(data){
              console.log(data.data);
            let count = data.data.length;
            let arr = data.data;
            let select = "";
            let button = "";

            if(count > 0){
                $('#errorNotif').hide();

                for (let i = 0; i < count; i++) {
                    select += `<option value="${arr[i]['id']}"> `+arr[i]['fname']+" "+  arr[i]['lname'] +`</option>`

                }
                $('#selectuser').html(select);
                $('#selectuser').show();
                $('#btnAdd').show();

            }else{
                $('#selectuser').hide();
                $('#btnAdd').hide();
                $('#errorNotif').show();
            }
            

           
          }

        });

        // END AJAX
      }
    })

})();
</script>
@endsection
