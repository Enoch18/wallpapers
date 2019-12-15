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
                    <li class="list-group-item list-group-item-action bg-light" style = "color: white;">WELCOME ADMIN</li><hr /> 
                    <a href="index.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-dashboard"></i> DASHBOARD </a><hr />
                    <ul class = "side" style = "margin-top: -40px;">
                        <li>
                            <a href = "/admin/ssgrouplogin/wallpapers" class="list-group-item list-group-item-action bg-light" id = "parent1"><i class="material-icons">collections</i> WALLPAPER</a>
                        </li>
                    </ul>

                    <ul class = "side">
                      <li><a href = "/admin/ssgrouplogin/categories" class="list-group-item list-group-item-action bg-light" id = "parent2"><i class="fa fa-th"></i> CATEGORIES</a></li>
                        <li><a href = "/admin/ssgrouplogin/subcategories" class="list-group-item list-group-item-action bg-light" id = "parent2"><i class="fa fa-th"></i> SUB-CATEGORIES </a></li>
                    </ul>
                    <a href="/admin/ssgrouplogin/topdownloads" class="list-group-item list-group-item-action bg-light"><i class="fa fa-download"></i> TOP DOWNLOADS</a>
                    <a href="/admin/ssgrouplogin/frontpages" class="list-group-item list-group-item-action bg-light"><i class="fa fa-align-justify"></i> FRONT PAGE CONTENT</a>
                    <a href="/admin/ssgrouplogin/subscribers" class="list-group-item list-group-item-action bg-light"><i class="material-icons">subscriptions</i> SUBSCRIBERS</a>
                    <a href="/admin/ssgrouplogin/unsubscribers" class="list-group-item list-group-item-action bg-light"><i class="material-icons">subscriptions</i> UNSUBSCRIBERS</a>
                    <a href="/admin/ssgrouplogin/newsletters" class="list-group-item list-group-item-action bg-light"><i class="fa fa-newspaper-o"></i> NEWS LETTERS</a>
                    <a href="/admin/ssgrouplogin/logindetails" class="list-group-item list-group-item-action bg-light"><i class="fa fa-gear"></i> LOGIN DETAILS</a>
                    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action bg-light"><i class="fa fa-sign-out"></i> LOGOUT</a>
                </div>
            </div>
        </div>

        <div class = "adminmaincontent">
            <nav id = "nav"></nav>

            {{-- Viewing Modifying and Adding Wallpapers  --}}
            @if ($value == "wallpapers")
                <div class = "wallpapers">
                    <div class = "">
                        <h3 align="center">All Wallpapers</h3>
                        <div align="right">
                            <button name = "addwallpaper" id = "addwallpaper" class = "btn btn-success btn-sm">Add Wallpaper</button>
                        </div><br />

                        <div class = "row">
                            @foreach($wallpaper as $wallpapers)
                                <div class = "col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <img src = "{{asset($wallpapers->url)}}" class = "img img-responsive img-thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ============================== Code for the Models --}}
                <div id = "formModal" class = "modal fade" role = "dialog">
                        <div class = "modal-dialog">
                            <div class = "modal-content">
                                <div class = "modal-header">
                                    <h4 class = "modal-title">Add New Wallpaper</h4>
                                    <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                                </div>
                    
                                <div class = "modal-content">
                                    <span id = "form_result"></span>
                                    <form method = "POST" id = "wallpaperupload" action = "wallpaper/add" enctype = "multipart/form-data">
                                        @csrf
                                        <div class = "form-group">
                                            <label class = "control-label col-md-12">Image Title/Name</label>
                                            <div class = "col-md-12">
                                                <input type = "text" name = "image_title" id = "image_title" class = "form-control"><br />
                                            </div>
                                        </div>
                    
                                        <div class = "form-group">
                                            <label class = "control-label col-md-12">Tags</label>
                                            <div class = "col-md-12">
                                                <input type = "text" name = "tags" id = "tags" class = "form-control"><br />
                                            </div>
                                        </div>

                                        <div class = "form-group">
                                            <label class = "control-label col-md-12" style = "text-align: left;">Category Name</label>
                                            <div class = "col-md-12">
                                                <select name = "category_id" id = "category_name" class = "form-control">
                                                    <option value = "">-- Select Category --</option>
                                                    @foreach ($category as $categories)
                                                        <option value = "{{$categories->id}}">{{$categories->cat_name}}</option>
                                                    @endforeach
                                                </select><br />
                                            </div>
                                        </div>
                    
                                        <div class = "form-group"><br />
                                            <label class = "control-label col-md-12">Wallpaper</label>
                                            <div class = "col-md-12">
                                                <input type = "file" name = "image" id = "image"><br />
                                            </div>
                                        </div>
                
                                        <div class = "form-group"><br />
                                            <label class = "control-label col-md-12">Author's Name</label>
                                            <div class = "col-md-12">
                                                <input type = "text" name = "author_name" id = "author_name" class = "form-control"><br />
                                            </div>
                                        </div>
                
                                        <div class = "form-group"><br />
                                            <label class = "control-label col-md-12">Author's Link</label>
                                            <div class = "col-md-12">
                                                <input type = "text" name = "author_link" id = "author_link" class = "form-control"><br />
                                            </div>
                                        </div>
                
                                        <div class = "form-group"><br />
                                            <label class = "control-label col-md-12">Make Live at</label>
                                            <div class = "col-md-12">
                                                <input type = "time" name = "live_at" id = "live_at" class = "form-control"><br />
                                            </div>
                                        </div>
                
                                        <div class = "form-group"><br />
                                            <label class = "control-label col-md-12">Wallpaper Description</label>
                                            <div class = "col-md-12">
                                                <textarea name = "description" id = "description" class = "form-control"></textarea><br />
                                            </div>
                                        </div>
                    
                                        <div class = "form-group">
                                            <div class = "col-md-8">
                                                <input type = "submit" name = "submit" id = "submit" class = "btn btn-warning"><br />
                                            </div>
                                        </div><br />
                                    </form>
                                    <br />
                                </div>
                            </div>
                    </div>
                </div>
            @endif

            {{-- Adding the Category --}}
            @if ($value == "categories")
                <div class = "container">
                <br />
                <h3 align = "center" >Categories</h3><br />
                <div align="right">
                    <button name = "addcategory" id = "addcategory" class = "btn btn-success btn-sm">Add Category</button>
                </div><br />
        
                <div class = "table-responsive">
                    <table class = "table table-bordered table-striped" id = "user_table">
                        <thread>
                            <tr>
                                <th width="10%">Category Name</th>
                                <th width="10%">Added On</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thread>
                    </table>  
                </div>
                </div>


                <div id = "categoryformModel" class = "modal fade" role = "dialog">
                    <div class = "modal-dialog">
                        <div class = "modal-content">
                            <div class = "modal-header">
                                <h4 class = "modal-title">Add New Category</h4>
                                <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                            </div>
                    
                            <div class = "modal-content">
                                <span id = "form_result"></span>
                                <form method = "POST" id = "sample_form" action = "category/add" class = "form-horizontal" enctype = "multipart/form-data">
                                    @csrf
                                    <div class = "form-group">
                                        <label class = "control-label col-md-12" style = "text-align: left;">Category Name</label>
                                        <div class = "col-md-12">
                                            <input type = "text" name = "category_name" id = "category_name" class = "form-control">
                                        </div>
                                    </div>
                    
                                    <div class = "form-group">
                                        <input type = "hidden" value = "Add" id = "action">
                                        <div class = "col-md-8">
                                            <input type = "submit" name = "submit" id = "submit" class = "btn btn-warning">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            {{-- Adding the Sub Category --}}
            @if ($value == "subcategories")
                <div class = "container">
                <br />
                <h3 align = "center" >Sub Categories</h3><br />
                <div align="right">
                    <button name = "addsubcategory" id = "addsubcategory" class = "btn btn-success btn-sm">Add Subcategory</button>
                </div><br />
        
                <div class = "table-responsive">
                    <table class = "table table-bordered table-striped" id = "user_table">
                        <thread>
                            <tr>
                                <th width="10%">Category Name</th>
                                <th width="10%">Sub-Category Name</th>
                                <th width="10%">Added On</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thread>
                    </table>  
                </div>
                </div>


                <div id = "subcategoryformModel" class = "modal fade" role = "dialog">
                    <div class = "modal-dialog">
                        <div class = "modal-content">
                            <div class = "modal-header">
                                <h4 class = "modal-title">Add New Category</h4>
                                <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                            </div>
                    
                            <div class = "modal-content">
                                <span id = "form_result"></span>
                                <form method = "POST" id = "wallpaperupload" action = "subcategory/add" class = "form-horizontal" enctype = "multipart/form-data">
                                    @csrf

                                    <div class = "form-group">
                                        <div class = "col-md-12">
                                            <label class = "control-label col-md-12" style = "text-align: left;">Category Name</label>
                                            <select name = "category_id" id = "category_id" class = "form-control">
                                                <option value = "">-- Select Category --</option>
                                                @foreach ($category as $categories)
                                                    <option value = "{{$categories->id}}">{{$categories->cat_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class = "form-group">
                                        <label class = "control-label col-md-12" style = "text-align: left;">Subcategory Name</label>
                                        <div class = "col-md-12">
                                            <input type = "text" name = "subcategory_name" id = "subcategory_name" class = "form-control">
                                        </div>
                                    </div>
                    
                                    <div class = "form-group">
                                        <div class = "col-md-8">
                                            <input type = "submit" name = "submit" id = "submit" class = "btn btn-warning">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    <section>
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

});
</script>

<script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'description' );
</script>