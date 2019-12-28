<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Panel</title>
        <link rel = "stylesheet" href = "{{asset('css/app.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    </head>
    <body id = "adminbody">
        <section>
            <div class = "adminsidebar">
                <div class="bg-light border-right" id="sidebar-wrapper">
                    <div class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action bg-light" style = "color: white;">WELCOME <br /><small>{{strtoupper(auth()->user()->name)}}</small></li><hr /> 
                        <a href="{{url('/admin/ssgrouplogin')}}" class="list-group-item list-group-item-action bg-light"><i class="fa fa-dashboard"></i> DASHBOARD </a><hr />
                        <ul class = "side" style = "margin-top: -40px;">
                            <li>
                                <a href = "{{url('/admin/ssgrouplogin/wallpapers')}}" class="list-group-item list-group-item-action bg-light" id = "parent1"><i class="material-icons">collections</i> WALLPAPER</a>
                            </li>
                        </ul>

                        <ul class = "side">
                        <li><a href = "{{url('/admin/ssgrouplogin/categories')}}" class="list-group-item list-group-item-action bg-light" id = "parent2"><i class="fa fa-th"></i> CATEGORIES</a></li>
                            <li><a href = "{{url('/admin/ssgrouplogin/subcategories')}}" class="list-group-item list-group-item-action bg-light" id = "parent2"><i class="fa fa-th"></i> SUB-CATEGORIES </a></li>
                        </ul>
                        <a href="{{url('/admin/ssgrouplogin/topdownloads')}}" class="list-group-item list-group-item-action bg-light"><i class="fa fa-download"></i> TOP DOWNLOADS</a>
                        <a href="{{url('/admin/ssgrouplogin/frontpages')}}" class="list-group-item list-group-item-action bg-light"><i class="fa fa-align-justify"></i> FRONT PAGE CONTENT</a>
                        <a href="{{url('/admin/ssgrouplogin/subscribers')}}" class="list-group-item list-group-item-action bg-light"><i class="material-icons">subscriptions</i> SUBSCRIBERS</a>
                        <a href="{{url('/admin/ssgrouplogin/unsubscribers')}}" class="list-group-item list-group-item-action bg-light"><i class="material-icons">subscriptions</i> UNSUBSCRIBERS</a>
                        <a href="{{url('/admin/ssgrouplogin/newsletters')}}" class="list-group-item list-group-item-action bg-light"><i class="fa fa-newspaper-o"></i> NEWS LETTERS</a>
                        <a href="{{url('/admin/ssgrouplogin/logindetails')}}" class="list-group-item list-group-item-action bg-light"><i class="fa fa-gear"></i> LOGIN DETAILS</a>
                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action bg-light" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> LOGOUT</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>

            <div class = "adminmaincontent">
                <nav id = "nav"></nav>
                @yield ('content')
            </div>

    </body>
</html>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
      $('#children1').hide();
      $('#children2').hide();
    
      $('#parent1').click(function(){
        $('#children2').hide();
        $('#children1').slideToggle();
      });
    
      $('#parent2').click(function(){
        $('#children1').hide();
        $('#children2').slideToggle();
      });
    
    // Adding the wallpaper
    $("#addwallpaper").click(function(){
        $("#formModal").modal('show');
    });
    
    // Adding the category
    $("#addcategory").click(function(){
        $("#categoryformModel").modal('show');
    });
    
    $("#addsubcategory").click(function(){
        $("#subcategoryformModel").modal('show');
    });
    
    //Confirming Delete
    $(".trash").click(function(){
        let path = "{{url('admin/ssgrouplogin/wallpaper/')}}/" + this.id;
        $("#yes").html("<a href = '"+path+"' class = 'btn btn-danger' style = 'width: 30%;'>Yes</a>");
        $("#deleteconfirm").modal('show');
    });

    $(".catdelete").click(function(){
        let path = "{{url('admin/ssgrouplogin/deletecategory/')}}/" + this.id;
        $("#yes").html("<a href = '"+path+"' class = 'btn btn-danger' style = 'width: 30%;'>Yes</a>");
        $("#deleteconfirm").modal('show');
    });
    
    $("#no").click(function(){
        $("#deleteconfirm").hide();
    });
    
    // Posting Image upload data to the database
    // $("#wallpaperupload").on("submit", function(event){
    //     event.preventDefault();
    //     alert($("#first_name").val());
    //     $.ajax({
    //         url: "admin/ssgrouplogin/wallpaper/add",
    //         method: "POST",
    //         data: new formData(this),
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         dataType: "json",
    //         success:function(data){
    //             alert('it is sent.');
    //             //$("#user_table").DataTable().ajax.reload();
    //         }
    //     });
    // });
    
        $("#changelogin").submit(function(e){
            if ($("#newpassword").val() != $("#confirmpassword").val()){
                $("#mismatch").show();
                return false;
            }
        });
    });
    </script>
    
    <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>