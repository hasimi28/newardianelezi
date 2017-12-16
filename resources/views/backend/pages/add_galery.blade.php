
    @extends('backend.adm_master')

    @section('head')
    <link rel="stylesheet" href="{{asset('css/themes/css/dropzone.css')}}" type="text/css">


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

                    <h3>Images <span id="photoCounter"></span></h3>
                    <br />

                    {!! Form::open(['url' => route('gallery.store'), 'class' => 'dropzone', 'files'=>true, 'id'=>'real-dropzone']) !!}

                    <div class="dz-message">

                    </div>

                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                    <div class="dropzone-previews" id="dropzonePreview"></div>

                    <h4 style="text-align: center;color:#428bca;">Drop images in this area  <span class="glyphicon glyphicon-hand-down"></span></h4>

                    {!! Form::close() !!}

                </div>
                <div class="jumbotron how-to-create">
                    <ul>
                        <li>Images are uploaded as soon as you drop them</li>
                        <li>Maximum allowed size of image is 8MB</li>
                    </ul>

                </div>
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

        {!! HTML::script('css/themes/js/dropzone.js') !!}
        {!! HTML::script('css/themes/js/dropzone-config.js') !!}
        <script type="text/javascript">
            var photo_counter = 0;
            Dropzone.options.realDropzone = {

                uploadMultiple: false,
                parallelUploads: 100,
                maxFilesize: 8,
                previewsContainer: '#dropzonePreview',
                previewTemplate: document.querySelector('#preview-template').innerHTML,
                addRemoveLinks: true,
                dictRemoveFile: 'Remove',
                dictFileTooBig: 'Image is bigger than 8MB',

                // The setting up of the dropzone
                init:function() {

                    this.on("removedfile", function(file) {

                        $.ajax({
                            type: 'POST',
                            url: 'upload/delete',
                            data: {id: file.name, _token: $('#csrf-token').val()},
                            dataType: 'html',
                            success: function(data){
                                var rep = JSON.parse(data);
                                if(rep.code == 200)
                                {
                                    photo_counter--;
                                    $("#photoCounter").text( "(" + photo_counter + ")");
                                }

                            }
                        });

                    } );
                },
                error: function(file, response) {
                    if($.type(response) === "string")
                        var message = response; //dropzone sends it's own error messages in string
                    else
                        var message = response.message;
                    file.previewElement.classList.add("dz-error");
                    _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                    _results = [];
                    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                        node = _ref[_i];
                        _results.push(node.textContent = message);
                    }
                    return _results;
                },
                success: function(file,done) {
                    photo_counter++;
                    $("#photoCounter").text( "(" + photo_counter + ")");
                }
            }
        </script>

    @endsection