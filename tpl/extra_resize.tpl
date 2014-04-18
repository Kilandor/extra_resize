<!-- BEGIN: MAIN -->
<script type="text/javascript">

var extra_names = $.parseJSON('{EXTRA_INPUT_NAME_JSON}')
var extra_names_titles = $.parseJSON('{EXTRA_INPUT_NAME_TITLES_JSON}')
$(function(ready){

	$("select[name='extra_location']").change(function() {
		extra_location = $(this).val()
		if(extra_location != '')
		{
			$("select[name='extra_name']").empty(); // remove old options
			$("select[name='extra_name']").append($("<option></option>").attr("value", null).text('---'));
			$.each(extra_names[extra_location], function(key, value) {
				title = extra_names_titles[extra_location][key]
				$("select[name='extra_name']").append($("<option></option>").attr("value", value).text(title));
			});
		}
		else
		{
			$("select[name='extra_name']").empty(); // remove old options
			$("select[name='extra_name']").append($("<option></option>").attr("value", null).text('---'));
		}
	});
});
</script>

<!-- BEGIN: INFO -->
<div>
	<!-- BEGIN: LOCATION -->
	<h1>Location: {EXTRA_LOCATION}</h1>
		<!-- BEGIN: NAME -->
		<div>
			<h3>Name: {EXTRA_NAME}</h3>
			<table>
				<tr>
					<td>Unique Name</td>
					<td>X</td>
					<td>Y</td>
					<td>JPG Quality</td>
					<td>Color Background</td>
					<td>Crop</td>
					<td>{PHP.L.Edit}</td>
					<td>{PHP.L.Delete}</td>
				</tr>
				<!-- BEGIN: LOOP -->
				<tr>
					<td>{EXTRA_THNAME}</td>
					<td>{EXTRA_X}</td>
					<td>{EXTRA_Y}</td>
					<td>{EXTRA_JPG_QUALITY}</td>
					<td>{EXTRA_COLORBG}</td>
					<td>{EXTRA_CROP}</td>
					<td><a href="{EXTRA_EDIT}">{PHP.L.Edit}</a></td>
					<td><a href="{EXTRA_DELETE}">{PHP.L.Delete}</a></td>
				</tr>
				<!-- END: LOOP -->
			</table>
		</div>
		<!-- END: NAME -->
	<!-- END: LOCATION -->
</div>
<!-- END: INFO -->



<form action="{EXTRA_SEND}" method="post" />
<table>
	<tr>
		<td>Extra Location</td>
		<td>{EXTRA_INPUT_LOCATION}</td>
	</tr>
	<tr>
		<td>Extra Name</td>
		<td>{EXTRA_INPUT_NAME}</td>
	</tr>
	<tr>
		<td>Thumbnail Unique Name</td>
		<td>{EXTRA_INPUT_THNAME}</td>
	</tr>
	<tr>
		<td>Thumbnail X</td>
		<td>{EXTRA_INPUT_X}</td>
	</tr>
	<tr>
		<td>Thumbnail Y</td>
		<td>{EXTRA_INPUT_Y}</td>
	</tr>
	<tr>
		<td>Thumbnail JPG Quality</td>
		<td>{EXTRA_INPUT_JPG_QUALITY}</td>
	</tr>
	<tr>
		<td>Thumbnail Color Background</td>
		<td>{EXTRA_INPUT_COLORBG}</td>
	</tr>
	<tr>
		<td>Thumbnail Crop</td>
		<td>{EXTRA_INPUT_CROP}</td>
	</tr>
	<!-- BEGIN: ADD -->
	<tr>
		<td colspan="2"><input type="submit" name="submit" value="{PHP.L.Submit}" /></td>
	</tr>
	<!-- END: ADD -->
	<!-- BEGIN: EDIT -->
	<tr>
		<td colspan="2"><input type="submit" name="submit" value="{PHP.L.Edit}" /></td>
	</tr>
	<!-- END: EDIT -->
</table>
</form>
<!-- END: MAIN -->