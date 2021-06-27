	var photoData = {
	    init: function() {
	        this.getPath();
			this.getPhotoInfo();
			this.searchData();
			this.getAlbumInfo();
			this.pageEvent();
			this.datadisablePhotoPaginationLink();
			this.datadisableAlbumPaginationLink();
			this.refereshContent();
			
	    },
	    pathname: "",
	    phototitle: "",
	    albumtitle: "",
	    photourl: "",
	    thumbnailurl: "",
		photoAlbumId: "",
		photoid:"",
		albumid:"",
		albumdatinfo:[],
		photodatainfo:[],
		page:1,
		albumpage:1,
		
	    getPath: function() {
	        var _this = this;
	        var path = document.location.pathname;
	        path = path.substring(0, path.lastIndexOf("/"));
	        path = path.substring(0, path.lastIndexOf("/"));
	        console.log(path);
			_this.pathname = path;
			
			console.log(_this.pathname);

	    },

	    getPhotoInfo: function() {
	        var _this = this;
	        var data = {};
	        console.log(_this.token);
	        if (_this.phototitle != "") {
	            data["title"] = _this.phototitle;
	        }

	        if (_this.photoAlbumId != "") {
	            data["albumId"] = _this.photoAlbumId;
	        }

	        if (_this.photoid != "") {
	            data["id"] = _this.photoid;
			}
			
			data.page = _this.page;

	        

	        console.log(data);

	        console.log(data);
	        $.ajax({
	            type: "GET",
	            url: _this.pathname + "/api/v1/photo",
	            data: data,
	            contentType: 'JSON',
	            success: function(data) {
	                console.log(data);
	                //stoploader("#userinfo");
					$(".photonext").prop("disabled",true);
					if(data.error)
					{
						$("#photodata tbody").html("<tr><td colspan='8' class='text-center'><strong>"+data.error+"</strong></td></tr>");
						
						return false;
					}
					_this.renderPhotoInfo(data);
					
	            },
	            error: function(error) {
	                console.log(error);
	            }
	        });


	    },

	    renderPhotoInfo: function(data) {
	        var _this = this;
			_this.datadisablePhotoPaginationLink();
			console.log(data.length);
			if(data.length>1)
			{
				$(".photonext").removeAttr("disabled","disabled");
			}
			$("#photodata tbody").empty();
	        var html = "";

	        for (i in data) {
				var j = i;
				
				_this.photodatainfo[data[i]['photo_id']] = data[i];
				var imgurl = "<img src='" + data[i]['url'] +"' />";
	
				var thumbsmall = "<img src='" + data[i]['thumbnail'] + "' clsas='img-responsive'/>";

				//console.log(tumbsmall);

				var imgthumb = '<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="left" title="'+imgurl+'" >'+thumbsmall+'</button>';

				console.log(imgthumb);

	            html += "<tr><td>" + (++j) + "</td>";
	            html += "<td>" + data[i]['photo_id'] + "</td>";
	            html += "<td>" + data[i]['album_id'] + "</td>";
	            html += "<td>" + data[i]['title'] + "</td>";
	            //html += "<td><img src='" + data[i]['url'] + "' clsas='img-responsive'/></td>";
	            html += "<td>"+imgthumb+"</td>";
				html += "<td>" + data[i]['createdon'] + "</td>";
				html += "<td>" + data[i]['updatedon'] + "</td>";
				html += "<td><button type='button' class='btn btn-primary btn-lg photodatabutton' value='"+data[i]['photo_id']+"' data-toggle='modal' data-target='#photoModal'>Edit</button></td>";
				html +="</tr>";
				
			
			}
	       
	        $("#photodata tbody").html(html);
	        

		},
		
		getAlbumInfo: function() {
	        var _this = this;
			var data = {};
			
	        
	        if (_this.albumtitle != "") {
	            data["title"] = _this.albumtitle;
	        }

	        if (_this.albumid != "") {
	            data["id"] = _this.albumid;
	        }

	      

	        data.page = _this.albumpage;

	        console.log(data);

	        console.log(data);
	        $.ajax({
	            type: "GET",
	            url: _this.pathname + "/api/v1/album",
	            data: data,
	            contentType: 'JSON',
	            success: function(data) {
	                console.log(data);
	                //stoploader("#userinfo");
					$(".albumnext").prop("disabled",true);
					if(data.error)
					{
						$("#albumdata tbody").html("<tr><td colspan='8' class='text-center'><strong>"+data.error+"</strong></td></tr>");
						
						return false;
					}
	                _this.renderAlbumInfo(data);
	            },
	            error: function(error) {
	                console.log(error);
	            }
	        });


	    },

	    renderAlbumInfo: function(data) {
			var _this = this;
			
			_this.datadisableAlbumPaginationLink();
			if(data.length>1)
			{
				$(".albumnext").removeAttr("disabled","disabled");
			}
	       
	        $("#albumdata tbody").empty();
	        var html = "";

	        for (i in data) {
				var j = i;
				
			_this.albumdatinfo[data[i]['album_id']] = data[i];
				

	            html += "<tr><td>" + (++j) + "</td>";
	            html += "<td>" + data[i]['album_id'] + "</td>";
	            html += "<td>" + data[i]['title'] + "</td>";
	            html += "<td>" + data[i]['createdon'] + "</td>";
				html += "<td>" + data[i]['updatedon'] + "</td>";
				html += "<td><button class='btn btn-primary btn-lg albumdatabutton' data-toggle='modal' id='"+data[i]['album_id']+"' data-target='#albumModal' value='"+data[i]['album_id']+"'><i class='glyphicon glyphicon-edit'></i></button></td>";
				html +="</tr>";
				
			
			}
		   
			console.log(_this.albumdatinfo);
	        $("#albumdata tbody").html(html);
	        

		},
		
		

	    searchData: function() {
	        var _this = this;

	        $(".phototitle").on('click', function() {
	            //$('#datebox').val($(this).text());
	           
				_this.phototitle="",
			
				_this.phototitle = $("#phototitletext").val();
			
				console.log(_this.phototitle);
				
				$("p.phototitleerror").html("");
	            console.log(_this.phototitle);
	            if (_this.phototitle == "") {
					console.log("Inside p errror");
	                $("p.phototitleerror").html("<strong>Please enter title</strong>");
	                return false;
				}
				
				_this.getPhotoInfo();
	            

			});
			

			$("#photoid").on('click', function() {
				_this.photoid="";
				_this.photoid = $("#photoidtext").val();
				$("p.photoiderror").html("");
	            console.log(_this.photoid);
	            if (_this.photoid == "") {
	                $("p.photoiderror").html("<strong>Please enter photo Id</strong>");
	                return false;
				}
				
				_this.getPhotoInfo();
			 
			});

			$("#albumid").on('click', function() {
				_this.photoAlbumId="",
				_this.photoAlbumId = $("#albumtext").val();

				$("p.albumiderror").html("");
	            console.log(_this.photoAlbumId);
	            if (_this.photoAlbumId == "") {
	                $("p.albumiderror").html("<strong>Please enter album Id</strong>");
	                return false;
				}
				

				_this.getPhotoInfo();
			});


			$(".albumtitle").on('click', function() {
	            //$('#datebox').val($(this).text());
	           
				_this.albumtitle="",
			
				_this.albumtitle = $("#albumtitletext").val();
			
				console.log(_this.albumtitle);
				
				$("p.albumtitleerror").html("");
	            console.log(_this.albumtitle);
	            if (_this.albumtitle == "") {
					console.log("Inside p errror");
	                $("p.albumtitleerror").html("<strong>Please enter title</strong>");
	                return false;
				}
				
				_this.getAlbumInfo();
	            

			});
			

			$("#albumparentid").on('click', function() {
				_this.albumid="";
				_this.albumid = $("#albumparentidtext").val();
				$("p.albumparentiderror").html("");
	            console.log(_this.albumid);
	            if (_this.albumid == "") {
	                $("p.albumparentiderror").html("<strong>Please enter photo Id</strong>");
	                return false;
				}
				_this.getAlbumInfo();
			 
			});


			$("#albumdata").on("click", ".albumdatabutton", function()
			{
				console.log("Inside button");
				var id = $(this).val();
				console.log(id);

				console.log(_this.albumdatinfo[id]['album_id']);

				$(".albumparentformid").val(_this.albumdatinfo[id]['album_id']);
				$(".albumformtitle").val(_this.albumdatinfo[id]['title']);
				$(".userformid").val(_this.albumdatinfo[id]['user_id']);
				
			});

			$("#photodata").on("click", ".photodatabutton", function()
			{
				console.log("Inside button");
				var id = $(this).val();
				console.log(id);

				console.log(_this.photodatainfo[id]['photo_id']);

				$(".photoformid").val(_this.photodatainfo[id]['photo_id']);
				$(".albumformid").val(_this.photodatainfo[id]['album_id']);
				$(".photoformtitle").val(_this.photodatainfo[id]['title']);
				$("#photoimgid").attr("src",_this.photodatainfo[id]['url']);
				$(".imgformurl").val(_this.photodatainfo[id]['url']);
				$("#photothumbimgid").attr("src",_this.photodatainfo[id]['thumbnail']);
				$(".imgthumbformurl").val(_this.photodatainfo[id]['thumbnail']);
				
			});



			$("#photoform").on("click", ".photodatabutton", function()
			{
				console.log("Submit button");
				var _this = this;
				var data = {};

				$("p.photosuccess").html("");
				$("p.photoerror").html("");

				if($("#photoformid").val()=="")
				{
					$("p.photoerror").html("Photo Id is mandatory");
					return false;
				}
				data.photo_id = $("#photoformid").val();

				if($("#albumformid").val()=="")
				{
					$("p.photoerror").html("Album Id is mandatory");
					return false;
				}
				data.album_id = $("#albumformid").val();
				
				if($("#photoformtitle").val()=="")
				{
					$("p.photoerror").html("Photo title is mandatory");
					return false;
				}
				data.title = $("#photoformtitle").val();

				if($("#imgformurl").val()=="")
				{
					$("p.photoerror").html("Photo url is mandatory");
					return false;
				}
				data.url = $("#imgformurl").val();

				if($("#imgthumbformurl").val()=="")
				{
					$("p.photoerror").html("Photo thumbnail url is mandatory");
					return false;
				}
				data.thumbnail = $("#imgthumbformurl").val();

				console.log(data);

				
				var path = document.location.pathname;
				path = path.substring(0, path.lastIndexOf("/"));
				path = path.substring(0, path.lastIndexOf("/"));
				console.log(path);
				_this.pathname = path;
				console.log(_this.pathname);
				
				$.ajax({
					type:"PUT",
					url: _this.pathname+"/api/v1/photo",
					dataType:'json',
					data:JSON.stringify(data),
					async:true,
					contentType: 'application/json',
					success:function (data) {
						console.log(data);
						
						console.log(data);
						
						if(!data.error)
						{
							$("p.photosuccess").html("Data updated successfully");
							$(document).ready(function(){
								photoData.init();
							});
							
							setTimeout(function(){ 
								$(function () {
									$('#photoModal').modal('hide');
									
								 });
								 }, 2000);
						
						}
						else{
							$("p.photoerror").html("Data update failed");
						}
					
					},
					error:function(error)
					{
						$("p.photoerror").html(error);
					}
				})

			});



		$("#albumform").on("click", ".albumdatabutton", function()
		{
				console.log("Submit button");
				var _this = this;
				var data = {};

				$("p.success").html("");
				$("p.error").html("");

				if($("#userformid").val()=="")
				{
					$("p.error").html("User Id is mandatory");
					return false;
				}
				data.user_id = $("#userformid").val();

				if($("#albumparentformid").val()=="")
				{
					$("p.error").html("Album Id is mandatory");
					return false;
				}
				data.album_id = $("#albumparentformid").val();
				
				if($("#albumformtitle").val()=="")
				{
					$("p.error").html("Album title is mandatory");
					return false;
				}
				data.title = $("#albumformtitle").val();
				
				console.log(data);

				
				var path = document.location.pathname;
				path = path.substring(0, path.lastIndexOf("/"));
				path = path.substring(0, path.lastIndexOf("/"));
				console.log(path);
				_this.pathname = path;
				console.log(_this.pathname);
				
				$.ajax({
					type:"PUT",
					url: _this.pathname+"/api/v1/album",
					dataType:'json',
					data:JSON.stringify(data),
					contentType: 'application/json',
					success:function (data) {
						console.log(data);
						
						if(!data.error)
						{
							$("p.success").html("Data updated successfully");
							$(document).ready(function(){
								photoData.init();
							});
							
							setTimeout(function(){ 
								$(function () {
									$('#albumModal').modal('hide');
									//window.getAlbumInfo();
								 });
								 }, 2000);
						
						}
						else{
							$("p.error").html("Data update failed");
						}
					
					},
					error:function(error)
					{
						$("p.error").html(error);
					}
				});

			});
	      
		},
		
		


		pageEvent:function()
		{
			var _this = this;
			$(".albumnext").off("click").on("click",function(){
				_this.albumpage++;
				_this.getAlbumInfo();
			});

			$(".albumprev").off("click").on("click",function(){
				_this.albumpage--;
				_this.getAlbumInfo();
			});

			$(".photonext").off("click").on("click",function(){
				_this.page++;
				_this.getPhotoInfo();
			});

			$(".photoprev").off("click").on("click",function(){
				_this.page--;
				_this.getPhotoInfo();
			});
		},

		datadisablePhotoPaginationLink:function()
		{
			var _this =this;
			if(_this.page<=1)
			{
				$(".photoprev").attr("disabled","disabled");
			}
			else
			{
				$(".photoprev").removeAttr("disabled");
			}
		},

		datadisableAlbumPaginationLink:function()
		{
			var _this =this;
			if(_this.albumpage<=1)
			{
				$(".albumprev").attr("disabled","disabled");
			}
			else
			{
				$(".albumprev").removeAttr("disabled");
			}
		},

		refereshContent:function()
		{
			var _this = this;

			$("#refereshphoto").click(function(){
				_this.photoAlbumId ="";
				_this.photoid = "";
				_this.phototitle="";
				_this.page =1;

				_this.getPhotoInfo();
			});

			$("#refereshalbum").click(function(){

				_this.albumtitle = "";
				_this.albumid = "";
				_this.albumpage=1;
				
				_this.getAlbumInfo();
			});
		}

	    
	};


	$(document).ready(function() {
	    photoData.init();
	});