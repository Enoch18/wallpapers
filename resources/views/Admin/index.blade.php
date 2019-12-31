@extends ('Admin.layout.app')

@section ('content')
            @if ($value == "dashboard")
                <div class = "dashboard">
                    <h3 align="center">Dashboard</h3>

                    <div class = "buttons">
                        <form method = "GET" action = "">
                            <input type = "hidden" name = "period" value = "alltimes">
                            <input type = "submit" value = "All Times" class = "btn btn-primary">
                        </form>

                        <form method = "GET" action = "">
                            <input type = "hidden" name = "period" value = "oneday">
                            <input type = "submit" value = "One Day" class = "btn btn-primary">
                        </form>

                        <form method = "GET" action = "">
                            <input type = "hidden" name = "period" value = "oneweek">
                            <input type = "submit" value = "One Week" class = "btn btn-primary">
                        </form>

                        <form method = "GET" action = "">
                            <input type = "hidden" name = "period" value = "onemonth">
                            <input type = "submit" value = "One Month" class = "btn btn-primary">
                        </form>
                    </div><br /><br />

                    <div class = "actualcontent">
                        <div class = "row">
                            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4> {{$interval}} </h4>
                            </div>
                        </div>

                        <div class = "row">
                            <div class = "col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class = "innerbox1">
                                    <h3>VISITS <br />{{$visits}} Visits</h3>
                                </div>
                            </div>

                            <div class = "col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class = "innerbox2">
                                    <h3>SUBSCRIBERS <br />{{$subscribers}} Subscribers</h3>
                                </div>
                            </div>

                            <div class = "col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class = "innerbox3">
                                    <h3>DOWNLOADS <br />{{$downloads}} Downloads</h3>
                                </div>
                            </div>

                            <div class = "col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                <div class = "innerbox4">
                                    <h3>TOTAL WALLPAPERS <br />{{$totalwallpapers}} Wallpapers</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Viewing Modifying and Adding Wallpapers  --}}
            @if ($value == "wallpapers")
                
                @if ($search == '')
                    <div class = "wallpapers">
                        <div class = "">
                            <h3 align="center">All Wallpapers</h3>
                            <div align="right">
                                <button name = "addwallpaper" id = "addwallpaper" class = "btn btn-success btn-sm">Add Wallpaper</button>
                            </div>

                            <div class = "row">
                                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <form class="form-inline" method = "GET" action = "{{url('admin/ssgrouplogin/wallpapers')}}">
                                        <input class="form-control mr-sm-2 search" type="search" id = "autocomplete" name = "search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-primary my-2 my-sm-0 searchbtn" type="submit"><i class = "fa fa-search"></i></button>
                                        <div id = "list" style = "position: absolute; margin-top: 40px; width: 200px; background-color: black !important;"></div>
                                    </form><br /><br />
                                </div>
                            </div>

                            <div class = "row">
                                @foreach($wallpaper as $wallpapers)
                                    <div class = "col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <div class = "image">
                                            <img src = "{{asset($wallpapers->url)}}" class = "img img-responsive img-thumbnail">
                                            <a href = "{{url('admin/ssgrouplogin/wallpaper/add')}}/{{$wallpapers->find($wallpapers->id)->details->id}}/edit" class = "btn btn-primary btn-admin" id = "edit"><i class = "fa fa-edit admin-fa"></i></a> <button class = "btn btn-danger btn-admin trash" id = "{{$wallpapers->id}}"><i class = "fa fa-trash admin-fa"></i></button><br /><br />
                                        </div>
                                        <p style = "color: black !important; text-align: center !important; margin-top: -10px;">{{$wallpapers->find($wallpapers->id)->details->image_title}}</p><br />
                                    </div>
                                @endforeach
                                <div class = "pagination">
                                    {!! $wallpaper->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($search != '')
                    <div class = "wallpapers">
                        <div class = "">
                            <h3 align="center">All Wallpapers</h3>
                            <div align="right">
                                <button name = "addwallpaper" id = "addwallpaper" class = "btn btn-success btn-sm">Add Wallpaper</button>
                            </div>

                            <div class = "row">
                                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <form class="form-inline" method = "GET" action = "{{url('admin/ssgrouplogin/wallpapers')}}">
                                        <input class="form-control mr-sm-2 search" type="search" name = "search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-primary my-2 my-sm-0 searchbtn" type="submit"><i class = "fa fa-search"></i></button>
                                    </form><br /><br />
                                    <h4>Search result for "{{ucwords($search)}}" ({{$resultscount}})</h4>
                                </div>
                            </div>

                            <div class = "row">
                                @foreach ($wallpaper as $wallpapers)
                                    <div class = "col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                        <div class = "image">
                                            <img src = "{{asset($wallpapers->url)}}" class = "img img-responsive img-thumbnail">
                                            <a href = "{{url('admin/ssgrouplogin/wallpaper/add')}}/{{$wallpapers->details_id}}/edit" class = "btn btn-primary btn-admin" id = "edit"><i class = "fa fa-edit admin-fa"></i></a> <button class = "btn btn-danger btn-admin trash" id = "{{$wallpapers->id}}"><i class = "fa fa-trash admin-fa"></i></button><br /><br />
                                        </div>
                                        <p style = "color: black !important; text-align: center !important; margin-top: -10px;">{{$wallpapers->image_title}}</p><br />
                                    </div>
                                @endforeach

                                <div class = "pagination">
                                    {!! $wallpaper->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

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
                                            <div class = "col-md-12" style = "max-height: 150px; overflow-y: auto;">
                                                @foreach ($category as $categories)
                                                    <input type = "checkbox" name = "category_id[]" value = "{{$categories->id}}"> {{$categories->cat_name}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                @endforeach
                                                <br /><br />
                                            </div>
                                        </div>

                                        @if (count($subcategory) > 0)
                                            <div class = "form-group">
                                                <label class = "control-label col-md-12" style = "text-align: left;">Subcategory Name</label>
                                                <div class = "col-md-12" style = "max-height: 150px; overflow-y: auto;">
                                                    @foreach ($subcategory as $subcategories)
                                                        <input type = "checkbox" name = "subcategory_id[]" value = "{{$subcategories->id}}"> {{$subcategories->sub_name}} &nbsp;&nbsp;&nbsp;&nbsp;
                                                    @endforeach
                                                    <br /><br />
                                                </div>
                                            </div>
                                        @endif
                    
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

            @if ($value == "newsletters")
                <div class = "newsletter container">
                    <h2>Newsletter</h2><br />
                    <form action = "" method = "post" enctype = "multipart/form-data">
                        @csrf
                        <div class = "row">
                            <div class = "col-lg-12" style = "margin-left:10px; margin-top: -15px;">
                                <label style = "font-weight: bold; margin-left: -10px;">Subject</label>
                            </div>
        
                            <div class = "col-lg-12 form-group">
                                <input type = "text" name = "subject" class = "form-control" placeholder = "Subject"><br /><br />
                            </div>
                        </div>
        
                        <div class = "row">
                            <div class = "col-lg-12" style = "margin-left:10px; margin-top: -20px;">
                                <label style = "font-weight: bold; margin-left: -10px;">Message</label>
                            </div>
        
                            <div class = "col-lg-12 form-group">
                                <textarea name = "message" id = "description" class = "form-control" maxlength = 300>
                                    Check out the latest wallpapers that were uploaded yesterday.    
                                </textarea><br /><br />
                            </div>
                        </div>
        
                        <div class = "row">
                            <div class = "col-lg-12" style = "margin-left:10px;">
                                <label style = "font-weight: bold; margin-left: -10px;">Choose Wallpapers from yesterday's upload</label>
                            </div>
                            <div class = "col-lg-12 form-group">
                                <div class = "row">
                                    @foreach ($wallpaper as $wallpapers)
                                        <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                            <label class = "checkbox-inline">
                                                <img src = "{{url($wallpapers->url)}}"class = "img img-responsive" style = "width: 100%; cursor: pointer;">
                                                <input type = "checkbox" name = "images[]" value = "{{$wallpapers->url}}" style = "float: right; height: 20px; width: 20px; margin-top: 1%;"><br /><br /><br />
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
        
                        <div class = "row">
                            {{-- <div class = "col-lg-12">
                                <input type = "submit" name = "submit" class = "btn btn-primary pull-left" value = "Send" style = "height:50px; width:200px; font-size:25px; margin-top: -30px;">
                            </div><br /><br /> --}}
                            <a class = "btn btn-primary">Send</a>
                        </div>
                    </form>
                </div>
            @endif

            @if ($value == "logindetails")
                <div class = "logindetails container">
                    <h2>Login Details</h2><br />
                    <div class = "row">
                        <div class = "col-lg-12">
                            <form class = "form-group" id = "changelogin" action = "{{url('admin/ssgrouplogin/login/update')}}" method = "POST">
                                @csrf
                                <label for = "name">Name</label>
                                <input type = "text" name = "name" class = "form-control" id = "name" value = "{{auth()->user()->name}}" placeholder = "Name"><br />

                                <label for = "email">Enter New Email</label>
                                <input type = "email" name = "email" class = "form-control" value = "{{auth()->user()->email}}"><br />
                                <input type = "password" name = "newpassword" id = "newpassword" class = "form-control" placeholder = "New Password"><br />
                                <input type = "password" name = "confirm" id = "confirmpassword" class = "form-control" placeholder = "Confirm Password">
                                <p id = "mismatch" style = "display: none !important;"><small style = "color: red !important;">Your passwords do not match!</small></p><br />
                                <input type = "submit" name = "editdetails" class = "form-control btn btn-primary col-lg-3" value = "Update">
                            </form>
                        </div>
                    </div>
                </div>
            @endif


            @if ($value == "topdownloads")
                <div class = "topd">
                    <h2>Top Downloaded Wallpapers</h2><br />
                    <div class = "row">
                        @foreach ($detail as $details)
                            @foreach ($wallpaper as $wallpapers)
                                @if ($details->id == $wallpapers->details_id)
                                    <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                        <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail">
                                        <p style="color: black !important;">{{$details->downloads ?? '0'}} Downloads</p><br /><br />
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                        <div class = "pagination">
                            {!! $wallpaper->render() !!}
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
                        <tr>
                            <th width="10%">Category Name</th>
                            <th width="10%">Added On</th>
                            <th width="10%">Action</th>
                        </tr>

                        @foreach($category as $categories)
                            <tr>
                                <td>{{$categories->cat_name}}</td>
                                <td>{{str_replace("-", "/", $categories->created_at)}}</td>
                                <td>
                                    <a href = "{{url('admin/ssgrouplogin/categories')}}?catid={{$categories->id}}" class = "btn btn-primary" style = "font-size: 14px !important;">Details</a> 
                                    <button class = "btn btn-primary catmodalrename" id = "{{$categories->cat_name}}_{{$categories->id}}">Rename</button> 
                                    <button class = "btn btn-danger catdelete" id = "{{$categories->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>  

                    <div class = "pagination">
                        {!! $category->render() !!}
                    </div>
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

                <div id = "renamecategoryformModel" class = "modal fade" role = "dialog">
                    <div class = "modal-dialog">
                        <div class = "modal-content">
                            <div class = "modal-header">
                                <h4 class = "modal-title">Rename Category</h4>
                                <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                            </div>
                    
                            <div class = "modal-content">
                                <span id = "form_result"></span>
                                <form method = "POST" id = "sample_form" action = "{{url('admin/ssgrouplogin/index/renames')}}" class = "form-horizontal" enctype = "multipart/form-data">
                                    @csrf
                                    <div class = "form-group">
                                        <label class = "control-label col-md-12" style = "text-align: left;">Category Rename</label>
                                        <div class = "col-md-12" id = "renamecategory">
                                            {{-- This code in jquery --}}
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

            @if ($value == "categorydetails")
                <div class = "container">
                    <br />
                    <h3 align = "center" >{{ucwords($cat_name)}} Category Details</h3><br />
                    <div align="right">
                        <button name = "addsubcategory" id = "addsubcategory" class = "btn btn-success btn-sm">Add Subcategory</button>
                    </div><br />
            
                    <div class = "table-responsive">
                        <table class = "table table-bordered table-striped" id = "user_table">
                            <tr>
                                <th width="10%">Sub-Category Name</th>
                                <th width="10%">Added On</th>
                            </tr>

                            @foreach($subcategory as $subcategories)
                                <tr>
                                    <td>{{$subcategories->sub_name}}</td>
                                    <td>{{str_replace("-", "/", $subcategories->created_at)}}</td>
                                </tr>
                            @endforeach
                        </table>  
                    </div>
                    <h4>Total Subcategories: {{$totalsubcategory}}</h4>
                    <h4>Total Wallpapers in Category: {{$totalwallpapers}}</h4>
                    <h4>Last Updated: {{str_replace('-', '/', $lastupdated)}}</h4>
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
                                        <label class = "control-label col-md-12" style = "text-align: left;">Subcategory Name</label>
                                        <div class = "col-md-12">
                                            <input type = "hidden" name = "category_id" value = "{{$catid}}">
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
                        <tr>
                            <th width="10%">Sub-Category Name</th>
                            <th width="10%">Added On</th>
                            <th width="10%">Action</th>
                        </tr>

                        @foreach($subcategory as $subcategories)
                            <tr>
                                <td>{{$subcategories->sub_name}}</td>
                                <td>{{str_replace("-", "/", $subcategories->created_at)}}</td>
                                <td>
                                    <button class = "btn btn-primary subcatrename" id = "{{$subcategories->sub_name}}_{{$subcategories->id}}">Rename</button> 
                                    <button class = "btn btn-danger subdelete" id = "{{$subcategories->id}}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>  

                    <div class = "pagination">
                        {!! $subcategory->render() !!}
                    </div>
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

                <div id = "renamesubcategoryformModel" class = "modal fade" role = "dialog">
                    <div class = "modal-dialog">
                        <div class = "modal-content">
                            <div class = "modal-header">
                                <h4 class = "modal-title">Rename Subcategory</h4>
                                <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                            </div>
                    
                            <div class = "modal-content">
                                <span id = "form_result"></span>
                                <form method = "POST" id = "sample_form" action = "{{url('admin/ssgrouplogin/index/renames')}}" class = "form-horizontal" enctype = "multipart/form-data">
                                    @csrf
                                    <div class = "form-group">
                                        <label class = "control-label col-md-12" style = "text-align: left;">Subcategory Rename</label>
                                        <div class = "col-md-12" id = "renamesubcategory">
                                            {{-- This code in jquery --}}
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

            @if ($value == "subscribers")
                <div class = "container subscribers">
                    <h2>Subscribers</h2>
                    <table class = "table table-bordered table-striped">
                        <tr>
                            <th width="10%">#</th>
                            <th width="10%">Email</th>
                            <th width="10%">Subscribed On</th>
                        </tr>

                        <?php $count = 0; ?>
                        @foreach ($subscriber as $subscribers)
                            <?php $count = $count + 1; ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$subscribers->email}}</td>
                                <td>{{$subscribers->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>  

                    <div class = "pagination">
                        {!! $subscriber->render() !!}
                    </div>
                </div>
            @endif

            @if ($value == "frontpages")
                <div class = "frontpage">
                    <h2>Home Page Image Categories</h2>
                    <div class = "row">
                        <div class = "col-md-4 col-lg-4">
                            <form action="{{url('admin/ssgrouplogin/index/tagdelete')}}" method="POST">
                                @csrf
                                <h4>Selected Categories</h4>
                                @foreach ($frontcategory as $categories)
                                    <input type = "checkbox" name = "cat_delete[]" value = "{{$categories->category_id}}" style = "display:none;" class = "catdel"> {{$categories->find($categories->id)->categories->cat_name}} &nbsp;&nbsp;&nbsp;&nbsp;
                                @endforeach
                                <br /><br />
                                <input type = "submit" value = "Delete" class = "btn btn-danger" style = "display: none;" id = "catdeletesubmit">
                                <p style = "color: red !important; text-decoration: underline; cursor: pointer;" id = "catdeleteclick">Remove Category</p>
                            </form>
                        </div>

                        <div class = "col-md-8 col-lg-8">
                            <h4>All Categories</h4>
                            <form action="{{url('admin/ssgrouplogin/index/frontpage')}}" method="POST">
                                @csrf
                                @foreach ($categorylist as $categories)
                                    <input type = "checkbox" name = "category_id[]" value = "{{$categories->id}}"> {{$categories->cat_name}} &nbsp;&nbsp;&nbsp;&nbsp;
                                @endforeach
                                <br /><br />
                                <input type="submit" value="Submit" class = "btn btn-primary">
                            </form>
                        </div>
                    </div><hr /><br />

                    <h2>Home Page Tags</h2>
                    <div class = "row">
                        <div class = "col-md-4 col-lg-4">
                            <h4>Active Tags</h4>
                            <form action="{{url('admin/ssgrouplogin/index/tagdelete')}}" method="POST">
                                @csrf
                                @foreach ($fronttags as $fronttag)
                                    <input type = "checkbox" name = "tag_delete[]" value = "{{$fronttag->tag_name}}" style = "display:none;" class = "tagdel"> {{$fronttag->tag_name}} 
                                    @foreach ($tag as $tags)
                                        @if ($tags->tag_name == $fronttag->tag_name)
                                            ({{$tags->where('tag_name', '=', $fronttag->tag_name)->count()}})
                                        @endif
                                    @endforeach
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                @endforeach
                                <br /><br />
                                <input type = "submit" value = "Delete" class = "btn btn-danger" style = "display: none;" id = "tagdeletesubmit">
                                <p style = "color: red !important; text-decoration: underline; cursor: pointer;" id = "tagdeleteclick">Remove Tags</p>
                            </form>
                        </div>

                        <div class = "col-md-8 col-lg-8">
                            <h4>All Tags</h4>
                            <form action="{{url('admin/ssgrouplogin/index/frontpage')}}" method="POST">
                                @csrf
                                @foreach ($tag as $tags)
                                    <input type = "checkbox" name = "tag_name[]" value = "{{$tags->tag_name}}"> {{$tags->tag_name}} ({{$tags->where('tag_name', '=', $tags->tag_name)->count()}}) &nbsp;&nbsp;&nbsp;&nbsp;
                                @endforeach
                                <br /><br />
                                <input type="submit" value="Submit" class = "btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div id = "deleteconfirm" class = "modal fade" role = "dialog">
            <div class = "modal-dialog">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h4 class = "modal-title" style = "color: black !important;">Confirm Delete</h4>
                        <button type = "button" class = "close" data-dismiss = "modal">&times;</button>
                    </div>
            
                    <div class = "modal-content">
                        <h4 style = "color: black !important;">Are you sure you want to delete?</h4><br />
                        <div>
                            <span id = "yes"></span>
                            <button type = "button" class = "btn btn-primary" class = "close" data-dismiss = "modal" style = "width: 30%; margin: 20px;">No</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection