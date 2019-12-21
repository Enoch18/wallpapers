@extends ('Admin.layout.app')

@section ('content')
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
                                    <div class = "image">
                                        <img src = "{{asset($wallpapers->url)}}" class = "img img-responsive img-thumbnail">
                                        <a href = "{{url('admin/ssgrouplogin/wallpaper/add')}}/{{{$wallpapers->find($wallpapers->id)->details->id}}}/edit" class = "btn btn-primary btn-admin" id = "edit"><i class = "fa fa-edit admin-fa"></i></a> <button class = "btn btn-danger btn-admin trash" id = "{{$wallpapers->id}}"><i class = "fa fa-trash admin-fa"></i></button><br /><br />
                                    </div>
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


            @if ($value == "topdownloads")
                <div class = "topd">
                    <h2>Top Downloaded Wallpapers</h2><br />
                    <div class = "row">
                        @foreach ($detail as $details)
                            @foreach ($wallpaper as $wallpapers)
                                @if ($details->id == $wallpapers->details_id)
                                    <div class = "col-xs-12 col-sm-12 col-md-4 col-lg-3">
                                        <img src = "{{url($wallpapers->url)}}" class = "img img-responsive img-thumbnail">
                                        <p>{{$details->downloads}} Downloads</p><br /><br />
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
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
                                <td><button class = "btn btn-danger">Delete</button></td>
                            </tr>
                        @endforeach
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
                        <tr>
                            <th width="10%">Sub-Category Name</th>
                            <th width="10%">Added On</th>
                            <th width="10%">Action</th>
                        </tr>

                        @foreach($subcategory as $subcategories)
                            <tr>
                                <td>{{$subcategories->sub_name}}</td>
                                <td>{{str_replace("-", "/", $subcategories->created_at)}}</td>
                                <td><button class = "btn btn-danger">Delete</button></td>
                            </tr>
                        @endforeach
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