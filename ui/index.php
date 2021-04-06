<html lang="en">

<head>
    <title>Rel JIO assignment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">


    <style>

    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <h2 class="text-center" style="color:white;">Rel Jio assignment</h2>
                    </div>
                </div>
            </nav>
        </div>

        <div class="row ">
            <div class=" col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Album Info</h3>

                    </div>
                    <div class="panel-body">
                        <div class="col-md-3">
                            <p class="albumtitleerror text-danger"></p>
                            <div class="input-group">
                                <input type="text" id="albumtitletext" class="form-control" placeholder="Enter album title" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2" style="padding: 1px;"><button class="btn btn-primary btn-sm input-group-text searchlist albumtitle" id="albumtitle">Search</button></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <p class="albumparentiderror text-danger"></p>
                            <div class="input-group">
                                <input type="number" id="albumparentidtext" class="form-control" placeholder="Enter album id" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2" style="padding: 1px;"><button class="btn btn-primary btn-sm input-group-text searchlist albumparentid" id="albumparentid">Search</button></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <p class="albumparentiderror text-danger"></p>
                            <div class="input-group">
                                <input type="button" id="refereshalbum" class="btn btn-warning" value="Refresh">

                            </div>
                        </div>




                        <div class="row">
                            <table id="albumdata" class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>SL#</th>
                                        <th>Album Id</th>
                                        <th>Title</th>
                                        <th>Created on</th>
                                        <th>Updated on</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <div class="row col-md-4 col-md-offset-8">
                            <button class="btn btn-primary albumnext pull-right">Next</button>
                            <button class="btn btn-primary albumprev pull-left">Previous</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class=" col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Photo Info</h3>
                    </div>
                    <div class="panel-body">

                        <div class="row" style="padding-bottom: 10px;">

                            <div class="col-md-3">
                                <p class="phototitleerror text-danger"></p>
                                <div class="input-group">
                                    <input type="text" id="phototitletext" class="form-control" placeholder="Enter photo title" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2" style="padding: 1px;"><button class="btn btn-primary btn-sm input-group-text searchlist phototitle" id="phototitle">Search</button></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <p class="albumiderror text-danger"></p>
                                <div class="input-group">
                                    <input type="number" id="albumtext" class="form-control" placeholder="Enter album id" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2" style="padding: 1px;"><button class="btn btn-primary btn-sm input-group-text searchlist albumid" id="albumid">Search</button></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <p class="photoiderror text-danger"></p>
                                <div class="input-group">
                                    <input type="number" id="photoidtext" class="form-control" placeholder="Enter photo id" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2" style="padding: 1px;"><button class="btn btn-primary btn-sm input-group-text searchlist photoid" id="photoid">Search</button></span>
                                </div>
                            </div>

                            <div class="col-md-3">

                                <input type="button" id="refereshphoto" class="btn btn-warning" value="Refresh">

                            </div>

                        </div>
                        <div class="row">
                            <table id="photodata" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL#</th>
                                        <th>Photo Id</th>
                                        <th>Album Id</th>
                                        <th>Title</th>
                                        <th>Image </th>
                                        <th>Created on</th>
                                        <th>Updated on</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <div class="row col-md-4 col-md-offset-8">
                            <button class="btn btn-primary photonext pull-right" disabled='disabled'>Next</button>
                            <button class="btn btn-primary photoprev pull-left" disabled='disabled'>Previous</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="albumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Album details</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="albumform">
                        <p class="success text-success"></p>
                        <p class="error text-danger"></p>
                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputLarge">Album Id</label>
                            <div class="col-sm-10">
                                <input class="form-control albumparentformid" type="text" id="albumparentformid" placeholder="album id" required disabled>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputSmall">Album title</label>
                            <div class="col-sm-10">
                                <input class="form-control albumformtitle" type="text" id="albumformtitle" placeholder="album title" required>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputSmall">User Id</label>
                            <div class="col-sm-10">
                                <input class="form-control userformid" type="text" id="userformid" placeholder="user id" required>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <div class="col-sm-8 col-sm-offset-4">
                                <input class="btn btn-success albumdatabutton" type="button" id="albumbutton" value="Submit" placeholder="Submit">
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Photo details</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="photoform">
                        <p class="photosuccess text-success"></p>
                        <p class="photoerror text-danger"></p>


                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputLarge">Photo Id</label>
                            <div class="col-sm-10">
                                <input class="form-control photoformid" type="text" id="photoformid" placeholder="photo id" required disabled>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputLarge">Album Id</label>
                            <div class="col-sm-10">
                                <input class="form-control albumformid" type="text" id="albumformid" placeholder="album id" required>
                            </div>
                        </div>
                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputSmall">Photo title</label>
                            <div class="col-sm-10">
                                <input class="form-control photoformtitle" type="text" id="photoformtitle" placeholder="photo title" required>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputSmall">Photo 600X600</label>
                            <div class="col-sm-10">
                                <img id="photoimgid" src="" class="img img-responsive" />
                                <input class="form-control imgformurl" type="text" id="imgformurl" placeholder="image url" required>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <label class="col-sm-2 control-label" for="formGroupInputSmall">Photo thumbnail</label>
                            <div class="col-sm-10">
                                <img id="photothumbimgid" src="" class="img img-responsive" />
                                <input class="form-control imgthumbformurl" type="text" id="imgthumbformurl" placeholder="image thumbnail url" required>
                            </div>
                        </div>

                        <div class="form-group form-group-sm">
                            <div class="col-sm-8 col-sm-offset-4">
                                <input class="btn btn-success photodatabutton" type="button" id="albumbutton" value="Submit" placeholder="Submit">
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="bootstrap/js/album.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("body").tooltip({
                selector: '[data-toggle=tooltip]',
                animated: 'fade',
                placement: 'bottom',
                html: true
            });
        });
    </script>
</body>

</html>