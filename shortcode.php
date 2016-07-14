<form class="find-a-distributor">
	<label for="radius">Search Radius</label>
	<select name="radius">
		<option value="10">10km</option>
		<option value="20">20km</option>
		<option value="50">50km</option>
		<option value="100">100km</option>
		<option value="500">500km</option>
	</select>
	<label for="address">Zip/Postal Code, Address, or City</label>
	<input type="text" name="address">
	<input type="submit">
	<ul class="found-distributors"></ul>
</form>

<div class="found-distributors-map" style="height:800px;"></div>

<?php	if ($output_maps):$output_maps=false;	?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&sensor=false"></script>
<script type="text/javascript">
function MarkerLabel_(e,t,n){this.marker_=e;this.handCursorURL_=e.handCursorURL;this.labelDiv_=document.createElement("div");this.labelDiv_.style.cssText="position: absolute; overflow: hidden;";this.eventDiv_=document.createElement("div");this.eventDiv_.style.cssText=this.labelDiv_.style.cssText;this.eventDiv_.setAttribute("onselectstart","return false;");this.eventDiv_.setAttribute("ondragstart","return false;");this.crossDiv_=MarkerLabel_.getSharedCross(t)}function MarkerWithLabel(e){e=e||{};e.labelContent=e.labelContent||"";e.labelAnchor=e.labelAnchor||new google.maps.Point(0,0);e.labelClass=e.labelClass||"markerLabels";e.labelStyle=e.labelStyle||{};e.labelInBackground=e.labelInBackground||false;if(typeof e.labelVisible==="undefined"){e.labelVisible=true}if(typeof e.raiseOnDrag==="undefined"){e.raiseOnDrag=true}if(typeof e.clickable==="undefined"){e.clickable=true}if(typeof e.draggable==="undefined"){e.draggable=false}if(typeof e.optimized==="undefined"){e.optimized=false}e.crossImage=e.crossImage||"http"+(document.location.protocol==="https:"?"s":"")+"://maps.gstatic.com/intl/en_us/mapfiles/drag_cross_67_16.png";e.handCursor=e.handCursor||"http"+(document.location.protocol==="https:"?"s":"")+"://maps.gstatic.com/intl/en_us/mapfiles/closedhand_8_8.cur";e.optimized=false;this.label=new MarkerLabel_(this,e.crossImage,e.handCursor);google.maps.Marker.apply(this,arguments)}MarkerLabel_.prototype=new google.maps.OverlayView;MarkerLabel_.getSharedCross=function(e){var t;if(typeof MarkerLabel_.getSharedCross.crossDiv==="undefined"){t=document.createElement("img");t.style.cssText="position: absolute; z-index: 1000002; display: none;";t.style.marginLeft="-8px";t.style.marginTop="-9px";t.src=e;MarkerLabel_.getSharedCross.crossDiv=t}return MarkerLabel_.getSharedCross.crossDiv};MarkerLabel_.prototype.onAdd=function(){var e=this;var t=false;var n=false;var r;var i,s;var o;var u;var a;var f;var l=20;var c="url("+this.handCursorURL_+")";var h=function(e){if(e.preventDefault){e.preventDefault()}e.cancelBubble=true;if(e.stopPropagation){e.stopPropagation()}};var p=function(){e.marker_.setAnimation(null)};this.getPanes().overlayImage.appendChild(this.labelDiv_);this.getPanes().overlayMouseTarget.appendChild(this.eventDiv_);if(typeof MarkerLabel_.getSharedCross.processed==="undefined"){this.getPanes().overlayImage.appendChild(this.crossDiv_);MarkerLabel_.getSharedCross.processed=true}this.listeners_=[google.maps.event.addDomListener(this.eventDiv_,"mouseover",function(t){if(e.marker_.getDraggable()||e.marker_.getClickable()){this.style.cursor="pointer";google.maps.event.trigger(e.marker_,"mouseover",t)}}),google.maps.event.addDomListener(this.eventDiv_,"mouseout",function(t){if((e.marker_.getDraggable()||e.marker_.getClickable())&&!n){this.style.cursor=e.marker_.getCursor();google.maps.event.trigger(e.marker_,"mouseout",t)}}),google.maps.event.addDomListener(this.eventDiv_,"mousedown",function(r){n=false;if(e.marker_.getDraggable()){t=true;this.style.cursor=c}if(e.marker_.getDraggable()||e.marker_.getClickable()){google.maps.event.trigger(e.marker_,"mousedown",r);h(r)}}),google.maps.event.addDomListener(document,"mouseup",function(i){var s;if(t){t=false;e.eventDiv_.style.cursor="pointer";google.maps.event.trigger(e.marker_,"mouseup",i)}if(n){if(u){s=e.getProjection().fromLatLngToDivPixel(e.marker_.getPosition());s.y+=l;e.marker_.setPosition(e.getProjection().fromDivPixelToLatLng(s));try{e.marker_.setAnimation(google.maps.Animation.BOUNCE);setTimeout(p,1406)}catch(a){}}e.crossDiv_.style.display="none";e.marker_.setZIndex(r);o=true;n=false;i.latLng=e.marker_.getPosition();google.maps.event.trigger(e.marker_,"dragend",i)}}),google.maps.event.addListener(e.marker_.getMap(),"mousemove",function(o){var c;if(t){if(n){o.latLng=new google.maps.LatLng(o.latLng.lat()-i,o.latLng.lng()-s);c=e.getProjection().fromLatLngToDivPixel(o.latLng);if(u){e.crossDiv_.style.left=c.x+"px";e.crossDiv_.style.top=c.y+"px";e.crossDiv_.style.display="";c.y-=l}e.marker_.setPosition(e.getProjection().fromDivPixelToLatLng(c));if(u){e.eventDiv_.style.top=c.y+l+"px"}google.maps.event.trigger(e.marker_,"drag",o)}else{i=o.latLng.lat()-e.marker_.getPosition().lat();s=o.latLng.lng()-e.marker_.getPosition().lng();r=e.marker_.getZIndex();a=e.marker_.getPosition();f=e.marker_.getMap().getCenter();u=e.marker_.get("raiseOnDrag");n=true;e.marker_.setZIndex(1e6);o.latLng=e.marker_.getPosition();google.maps.event.trigger(e.marker_,"dragstart",o)}}}),google.maps.event.addDomListener(document,"keydown",function(t){if(n){if(t.keyCode===27){u=false;e.marker_.setPosition(a);e.marker_.getMap().setCenter(f);google.maps.event.trigger(document,"mouseup",t)}}}),google.maps.event.addDomListener(this.eventDiv_,"click",function(t){if(e.marker_.getDraggable()||e.marker_.getClickable()){if(o){o=false}else{google.maps.event.trigger(e.marker_,"click",t);h(t)}}}),google.maps.event.addDomListener(this.eventDiv_,"dblclick",function(t){if(e.marker_.getDraggable()||e.marker_.getClickable()){google.maps.event.trigger(e.marker_,"dblclick",t);h(t)}}),google.maps.event.addListener(this.marker_,"dragstart",function(e){if(!n){u=this.get("raiseOnDrag")}}),google.maps.event.addListener(this.marker_,"drag",function(t){if(!n){if(u){e.setPosition(l);e.labelDiv_.style.zIndex=1e6+(this.get("labelInBackground")?-1:+1)}}}),google.maps.event.addListener(this.marker_,"dragend",function(t){if(!n){if(u){e.setPosition(0)}}}),google.maps.event.addListener(this.marker_,"position_changed",function(){e.setPosition()}),google.maps.event.addListener(this.marker_,"zindex_changed",function(){e.setZIndex()}),google.maps.event.addListener(this.marker_,"visible_changed",function(){e.setVisible()}),google.maps.event.addListener(this.marker_,"labelvisible_changed",function(){e.setVisible()}),google.maps.event.addListener(this.marker_,"title_changed",function(){e.setTitle()}),google.maps.event.addListener(this.marker_,"labelcontent_changed",function(){e.setContent()}),google.maps.event.addListener(this.marker_,"labelanchor_changed",function(){e.setAnchor()}),google.maps.event.addListener(this.marker_,"labelclass_changed",function(){e.setStyles()}),google.maps.event.addListener(this.marker_,"labelstyle_changed",function(){e.setStyles()})]};MarkerLabel_.prototype.onRemove=function(){var e;this.labelDiv_.parentNode.removeChild(this.labelDiv_);this.eventDiv_.parentNode.removeChild(this.eventDiv_);for(e=0;e<this.listeners_.length;e++){google.maps.event.removeListener(this.listeners_[e])}};MarkerLabel_.prototype.draw=function(){this.setContent();this.setTitle();this.setStyles()};MarkerLabel_.prototype.setContent=function(){var e=this.marker_.get("labelContent");if(typeof e.nodeType==="undefined"){this.labelDiv_.innerHTML=e;this.eventDiv_.innerHTML=this.labelDiv_.innerHTML}else{this.labelDiv_.innerHTML="";this.labelDiv_.appendChild(e);e=e.cloneNode(true);this.eventDiv_.appendChild(e)}};MarkerLabel_.prototype.setTitle=function(){this.eventDiv_.title=this.marker_.getTitle()||""};MarkerLabel_.prototype.setStyles=function(){var e,t;this.labelDiv_.className=this.marker_.get("labelClass");this.eventDiv_.className=this.labelDiv_.className;this.labelDiv_.style.cssText="";this.eventDiv_.style.cssText="";t=this.marker_.get("labelStyle");for(e in t){if(t.hasOwnProperty(e)){this.labelDiv_.style[e]=t[e];this.eventDiv_.style[e]=t[e]}}this.setMandatoryStyles()};MarkerLabel_.prototype.setMandatoryStyles=function(){this.labelDiv_.style.position="absolute";this.labelDiv_.style.overflow="hidden";if(typeof this.labelDiv_.style.opacity!=="undefined"&&this.labelDiv_.style.opacity!==""){this.labelDiv_.style.MsFilter='"progid:DXImageTransform.Microsoft.Alpha(opacity='+this.labelDiv_.style.opacity*100+')"';this.labelDiv_.style.filter="alpha(opacity="+this.labelDiv_.style.opacity*100+")"}this.eventDiv_.style.position=this.labelDiv_.style.position;this.eventDiv_.style.overflow=this.labelDiv_.style.overflow;this.eventDiv_.style.opacity=.01;this.eventDiv_.style.MsFilter='"progid:DXImageTransform.Microsoft.Alpha(opacity=1)"';this.eventDiv_.style.filter="alpha(opacity=1)";this.setAnchor();this.setPosition();this.setVisible()};MarkerLabel_.prototype.setAnchor=function(){var e=this.marker_.get("labelAnchor");this.labelDiv_.style.marginLeft=-e.x+"px";this.labelDiv_.style.marginTop=-e.y+"px";this.eventDiv_.style.marginLeft=-e.x+"px";this.eventDiv_.style.marginTop=-e.y+"px"};MarkerLabel_.prototype.setPosition=function(e){var t=this.getProjection().fromLatLngToDivPixel(this.marker_.getPosition());if(typeof e==="undefined"){e=0}this.labelDiv_.style.left=Math.round(t.x)+"px";this.labelDiv_.style.top=Math.round(t.y-e)+"px";this.eventDiv_.style.left=this.labelDiv_.style.left;this.eventDiv_.style.top=this.labelDiv_.style.top;this.setZIndex()};MarkerLabel_.prototype.setZIndex=function(){var e=this.marker_.get("labelInBackground")?-1:+1;if(typeof this.marker_.getZIndex()==="undefined"){this.labelDiv_.style.zIndex=parseInt(this.labelDiv_.style.top,10)+e;this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex}else{this.labelDiv_.style.zIndex=this.marker_.getZIndex()+e;this.eventDiv_.style.zIndex=this.labelDiv_.style.zIndex}};MarkerLabel_.prototype.setVisible=function(){if(this.marker_.get("labelVisible")){this.labelDiv_.style.display=this.marker_.getVisible()?"block":"none"}else{this.labelDiv_.style.display="none"}this.eventDiv_.style.display=this.labelDiv_.style.display};MarkerWithLabel.prototype=new google.maps.Marker;MarkerWithLabel.prototype.setMap=function(e){google.maps.Marker.prototype.setMap.apply(this,arguments);this.label.setMap(e)}
</script>
<?php	endif;	?>

<script type="text/javascript">
	(function () {
		var $=jQuery;
		var curr=$('script').last();
		var form=curr.prevAll('form.find-a-distributor').first();
		var found=form.find('.found-distributors').first();
		var map_container=curr.prevAll('div.found-distributors-map').first();
		var map=new google.maps.Map(map_container[0],{
			zoom: 3,
			center: new google.maps.LatLng(46.0730555556,-100.546666667),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false
		});
		var get=function (name) {
			var str=form.find('input[name="'+name+'"]').val().trim();
			if (str==='') return null;
			return str;
		};
		var markers=[];
		var info_windows=[];
		var bounds=null;
		var close_windows=function () {	info_windows.forEach(function (iw) {	iw.close();	});	};
		var add_distributor=function (dist) {
			var pos=new google.maps.LatLng(dist.lat,dist.lng);
			if (bounds===null) bounds=new google.maps.LatLngBounds();
			bounds.extend(pos);
			var marker=new MarkerWithLabel({
				position: pos,
				draggable: false,
				map: map,
				raiseOnDrag: false
			});
			markers.push(marker);
			var ie=document.createElement('div');
			ie.setAttribute('class','found-distributor');
			ie.innerHTML=dist.html;
			var info_window=new google.maps.InfoWindow({
				//	TODO: Change this?
				content: ie.outerHTML,
				disableAutoPan: true,
				position: pos
			});
			info_windows.push(info_window);
			var open=function () {
				close_windows();
				map.setCenter(pos);
				info_window.open(map);
			};
			google.maps.event.addListener(marker,'click',open);
			var e=document.createElement('li');
			e.setAttribute('class','found-distributor');
			e.innerHTML=dist.html;
			found[0].appendChild(e);
			$(e).click(open);
		};
		var update=function (obj) {
			map.setCenter(new google.maps.LatLng(obj.lat,obj.lng));
			var arr=obj.results;
			arr.sort(function (a, b) {	return a.distance-b.distance;	});
			bounds=null;
			arr.forEach(add_distributor);
			if (bounds!==null) map.fitBounds(bounds);
		};
		form.submit(function (e) {
			e.preventDefault();
			found.empty();
			markers.forEach(function (marker) {	marker.setMap(null);	});
			markers=[];
			close_windows();
			info_windows=[];
			var radius=parseFloat(form.find('*[name="radius"]').val());
			if (isNaN(radius)) return;
			var address=get('address');
			if (address===null) return;
			var query='?action=fgms_distributor_radius&address='+encodeURIComponent(address)+'&radius='+encodeURIComponent(radius);
			var url=<?php	echo(json_encode(admin_url('admin-ajax.php')));	?>+query;
			var xhr=$.ajax(url);
			xhr.fail(function (xhr, text, e) {	alert(xhr.statusText);	});
			xhr.done(function (data, text, xhr) {
				var obj=JSON.parse(xhr.responseText);
				update(obj);
			});
		});
	})();
</script>