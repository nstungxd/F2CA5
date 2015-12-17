
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">   
var geocoder;  
var map;  
var marker=null;  
  
function initialize(){  
    geocoder = new google.maps.Geocoder();  
    var latlng = new google.maps.LatLng(37.566615, 126.977958);  
    var myOptions = {  
        zoom: 8,  
        center: latlng,  
        mapTypeId: google.maps.MapTypeId.ROADMAP  
    }  
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);  
}  
  
function codeAddress(){  
    var address = document.getElementById("address").value;  
    var r = document.getElementById("r");
    r.innerHTML = '';  
      
    geocoder.geocode({  
        'address': address  
    }, function(results, status){  
        if (status == google.maps.GeocoderStatus.OK) {  
            map.setCenter(results[0].geometry.location);  
            //addMark(results[0].geometry.location.lat(), results[0].geometry.location.lng());  

            var html = "<ul>";
            for(var i in  results){  
                html += "<li>"+"<a href='"+"javascript:addMark(" + results[i].geometry.location.lat() + ", " + results[i].geometry.location.lng() + ");"+"'>";
                html += results[i].formatted_address;
                html += "</a></li>";

                //r.innerHTML += results[i].formatted_address+',';  


                // var li = document.createElement('li');  
                // var a = document.createElement('a');  
                // a.href = "javascript:addMark(" + results[i].geometry.location.lat() + ", " + results[i].geometry.location.lng() + ");";  
                // a.innerHTML = results[i].formatted_address;  
   
                // li.appendChild(a);  
                // r.appendChild(li);  
            } 
            html += "</ul>";
            r.innerHTML = html;
        } else {  
            r.innerHTML = "검색 결과가 없습니다.";
        }  
    });  
}  
  
function addMark(lat, lng){  
    if(marker!=null){
        marker = null;
        marker.setMap(null);
    }
	map.setCenter(new google.maps.LatLng(lat, lng));
    marker = new google.maps.Marker({
        map: map,  
        position: new google.maps.LatLng(lat, lng)  
    });

    selectPosition();
}

function selectPosition() {
    if(marker==null){
        alert("아이템을 선택하세요");
        return;
    }

	var lat = marker.position.lat();
	var lng = marker.position.lng();
    marker =null;

	setPosition(lat, lng);

    // var r = document.getElementById("r");
    // r.innerHTML = '';

	$.magnificPopup.close();
}

window.onload = initialize;
</script>

<div id="geocode-dialog" class="zoom-anim-dialog mfp-hide" style="max-width: 550px; position: relative; margin: 20px auto; background: none repeat scroll 0% 0% #FFF; padding: 20px;">
	<div style="float:left">
	    <input id="address" type="textbox" value="" placeholder="검색하려는 주소를 입력하세요" style="width: 200px;">   
	    <button class="button" onclick="codeAddress();" style="width: 50px; height: 25px; vertical-align: inherit;">검색</button>
	</div>
	<!-- <div style="float:right">
        <button class="button" onclick="selectPosition();" style="width: 50px; height: 25px; vertical-align: inherit;">선택</button>
	</div> -->
	<div class="clearfix"></div>
	<hr/>
	<div id="r"></div>    
	<div id="map_canvas" style="height:300px;margin-top:10px"></div>   
</div>