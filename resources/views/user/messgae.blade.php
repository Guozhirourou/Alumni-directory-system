@if(count($errors)>0)
    <div class="message alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">
            &times;
        </a>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
    <script>
        setTimeout(function(){
            $('.message').slideUp("slow");
        },3000)
    </script>
@endif

