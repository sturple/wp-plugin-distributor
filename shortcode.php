<form class="find-a-distributor">
	<label for="radius">Search Radius (km)</label>
	<input type="text" name="radius">
	<label for="address">Address</label>
	<input type="text" name="address">
	<label for="city">City</label>
	<input type="text" name="city">
	<label for="territorial_unit">State/Province</label>
	<input type="text" name="territorial_unit">
	<label for="country">Country</label>
	<input type="text" name="country">
	<input type="submit">
</form>

<div class="found-distributors"></div>

<script type="text/javascript">
	(function () {
		var $=jQuery;
		var curr=$('script').last();
		var form=curr.prevAll('form').first();
		var found=curr.prevAll('div').first();
		var get=function (name) {
			var str=form.find('input[name="'+name+'"]').val().trim();
			if (str==='') return null;
			return str;
		};
		form.submit(function (e) {
			e.preventDefault();
			found.empty();
			var radius=parseFloat(form.find('input[name="radius"]').val());
			if (isNaN(radius)) return;
			var address=get('address');
			if (address===null) return;
			var city=get('city');
			if (city===null) return;
			var tu=get('territorial_unit');
			var country=get('country');
			if (country===null) return;
			var query='?action=fgms_distributor_radius&address=';
			query+=encodeURIComponent(address);
			query+='&city=';
			query+=encodeURIComponent(city);
			query+='&radius=';
			query+=encodeURIComponent(radius);
			query+='&country=';
			query+=encodeURIComponent(country);
			if (tu!==null) {
				query+='&territorial_unit=';
				query+=encodeURIComponent(tu);
			}
			var url=<?php	echo(json_encode(admin_url('admin-ajax.php')));	?>+query;
			var xhr=$.ajax(url);
			xhr.fail(function (xhr, text, e) {	alert(text);	});
			xhr.done(function (data, text, xhr) {
				var arr=JSON.parse(xhr.responseText);
				arr.sort(function (a, b) {	return a.dist-b.dist;	});
				arr.forEach(function (dist) {
					var e=document.createElement('div');
					e.setAttribute('class','found-distributor');
					var h=document.createElement('h3');
					h.setAttribute('class','found-distributor-name');
					h.appendChild(document.createTextNode(dist.name));
					e.appendChild(h);
					found[0].appendChild(e);
				});
			});
		});
	})();
</script>