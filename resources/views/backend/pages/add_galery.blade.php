
    @extends('backend.adm_master')

    @section('head')
        <link rel="stylesheet" href="{{asset('css/themes/css/dropzone.min.css')}}" type="text/css">


    @endsection
    @section('content')
        <style>

            .thumbnail {
                width:150px;
                height:100px;
                position:relative;
            }

            .thumbnail img {
                max-width:100%;
                max-height:100%;
            }

            .thumbnail a {
                position: absolute; top: 4px; right: 5px;
                color:red;
                background-color: white;
                padding:5px;
            }
        </style>
        <div class="page-title">
            <div>
                <h1><i class="fa fa-edit"></i> Form Components</h1>
                <p>Bootstrap default form components</p>
            </div>
            <div>
                <ul class="breadcrumb">
                    <li><i class="fa fa-home fa-lg"></i></li>
                    <li>Forms</li>
                    <li><a href="#">Create Users</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="jumbotron how-to-create" >


                    {!! Form::open(['url' => route('gallery.store'), 'class' => 'dropzone',  'id'=>'my-dropzone']) !!}

                    {{csrf_field()}}

                    <div class="form-group">


                        <div class="col-lg-12">

                            <select class="form-control" id="select" name="category_id">
                                @foreach($cat as $c)
                                <option value="{{$c->id}}">{{$c->NameTrans('name')}}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    <div class="dropzone-previews"></div>


                    {!! Form::close() !!}

                </div>
                <button type="submit" id="submit-all" class="btn btn-primary btn-xs">Upload the file</button>
            </div>
        </div>

        <!-- Dropzone Preview Template -->
        <div id="preview-template" style="display: none;">

            <div class="dz-preview dz-file-preview">
                <div class="dz-image"><img data-dz-thumbnail=""></div>

                <div class="dz-details">
                    <div class="dz-size"><span data-dz-size=""></span></div>
                    <div class="dz-filename"><span data-dz-name=""></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
                <div class="dz-error-message"><span data-dz-errormessage=""></span></div>




            </div>
        </div>
        <!-- End Dropzone Preview Template -->


        {!! Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) !!}
    @endsection

    @section('js')

        <script src=" {!! asset('css/themes/js/dropzone.js') !!}"  ></script>

        <script type="text/javascript">
            Dropzone.options.myDropzone = {
                maxFilesize: 5, //mb- Image files not above this size
                uploadMultiple: true, // set to true to allow multiple image uploads
                parallelUploads: 1, //all images should upload same time
                maxFiles: 15, //number of images a user should upload at an instance
                acceptedFiles: ".png,.jpg,.jpeg", //allowed file types, .pdf or anyother would throw error
                // addRemoveLinks: true, // add a remove link underneath each image to
                autoProcessQueue: false, // Prevents Dropzone from uploading dropped files immediately

                removedfile: function(file) {
                    var name = file.name;
                    if (name) {
                        $.ajax({
                            headers:{
                                'X-CSRF-Token':$('input[name="_token"]').val()
                            }, //passes the current token of the page to image url
                            type: 'GET',
                            url: "/products/remove/"+name,  //passes the image name to  the method handling this url to //remove file
                            dataType: 'json'
                        });
                    }
                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
                init: function() {
                    var submitButton = document.querySelector("#submit-all")
                    myDropzone = this; // closure
                    submitButton.addEventListener("click", function() {
                        myDropzone.processQueue(); // Tell Dropzone to process all queued files.
                    });
// You might want to show the submit button only when
                    // files are dropped here:
                    this.on("addedfile", function() {
                        // Show submit button here and/or inform user to click it.
                    });
                }
            };
        </script>

    @endsection