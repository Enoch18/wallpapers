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
                <nav id = "nav">
                    <button class = "btn btn-primary" id = "togglebtn1" style="margin-top: 5px; margin-left: 5px;"><i class = "fa fa-align-justify"></i></button>
                    <button class = "btn btn-primary" id = "togglebtn2" style="margin-top: 5px; margin-left: 5px; display: none;"><i class = "fa fa-align-justify"></i></button>
                </nav>
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

      if ($(window).width() > 990){
        $("#togglebtn1").click(function(){
                $("#togglebtn2").show();
                $("#nav").css({
                    marginLeft: '0px'
                });
                $("#togglebtn1").hide();
                $(".adminsidebar").hide();
        });

        $("#togglebtn2").click(function(){
                $("#togglebtn2").hide();
                $("#nav").css({
                    marginLeft: '252px'
                });
                $("#togglebtn1").show();
                $(".adminsidebar").show();
        });
      }else{
        $("#togglebtn2").show();
        $("#togglebtn1").hide();
        $("#togglebtn1").click(function(){
                $("#togglebtn2").show();
                $("#nav").css({
                    marginLeft: '0px'
                });
                $("#togglebtn1").hide();
                $(".adminsidebar").hide();
        });

        $("#togglebtn2").click(function(){
                $("#togglebtn2").hide();
                $("#nav").css({
                    marginLeft: '252px'
                });
                $("#togglebtn1").show();
                $(".adminsidebar").show();
        });
      }
    
    // Adding the wallpaper
    $("#addwallpaper").click(function(){
        $("#formModal").modal('show');
    });

    $(".catmodalrename").click(function(){
        let catname = this.id;
        let split = catname.split("_");
        let cat_name = split[0];
        let cat_id = split[1];

        $("#renamecategory").html("<input type = 'text' name = 'cat_name' id = 'cat_name' value = '"+cat_name+"' class = 'form-control'> <input type = 'hidden' name = 'cat_id' value = '"+cat_id+"' class = 'form-control'>");
        $("#renamecategoryformModel").modal('show');
    });

    $(".subcatrename").click(function(){
        let subname = this.id;
        let split = subname.split("_");
        let sub_name = split[0];
        let sub_id = split[1];


        $("#renamesubcategory").html("<input type = 'text' name = 'sub_name' value = '"+sub_name+"' class = 'form-control'> <input type = 'hidden' name = 'sub_id' value = '"+sub_id+"' class = 'form-control'>");
        $("#renamesubcategoryformModel").modal('show');
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

    $(".subdelete").click(function(){
        let path = "{{url('admin/ssgrouplogin/deletesubcategory/')}}/" + this.id;
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

        $("#tagdeleteclick").click(function(){
            $(".tagdel").show();
            $("#tagdeleteclick").hide();
            $("#tagdeletesubmit").show();
        });

        $("#catdeleteclick").click(function(){
            $(".catdel").show();
            $("#catdeleteclick").hide();
            $("#catdeletesubmit").show();
        });

        $("#rmcattrigger").click(function(){
            $(".rmcat").show();
            $("#rmcatbtn").show();
            $("#rmcattrigger").hide();
        });

        $("#rmsubtrigger").click(function(){
            $(".rmsub").show();
            $("#rmsubbtn").show();
            $("#rmsubtrigger").hide();
        });

        $("#renametrigger").click(function(){
            $(".renametag").show();
            $(".wallpapertags").hide();
            $("#renametagbtn").show();
            $("#renametrigger").hide();
            $("#rmtagtrigger").hide();
            $("#rmtagbtn").hide();
        });

        $("#rmtagtrigger").click(function(){
            $(".rmtag").show();
            $("#rmtagbtn").show();
            $("#rmtagtrigger").hide();
            $("#renametrigger").hide();
            $("#renametagbtn").hide();
        });
    });
    </script>
    
    <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>