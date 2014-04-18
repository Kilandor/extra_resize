<!-- BEGIN: MAIN -->
<script>
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
  <!-- BEGIN: LOCATION -->
  <div class="panel panel-default">
    <div class="panel-heading">Location: {EXTRA_LOCATION}</div>
    <div class="panel-body">
      <!-- BEGIN: NAME -->
      <h4>Name: {EXTRA_NAME}</h4>
      <table class="table table-striped">
        <thead>
          <th>Unique Name</th>
          <th>X</th>
          <th>Y</th>
          <th>JPG Quality</th>
          <th>Color Background</th>
          <th>Crop</th>
          <th>&nbsp;</th>
        </thead>
        <tbody>
          <!-- BEGIN: LOOP -->
          <tr>
            <td>{EXTRA_THNAME}</td>
            <td>{EXTRA_X}</td>
            <td>{EXTRA_Y}</td>
            <td>{EXTRA_JPG_QUALITY}</td>
            <td>{EXTRA_COLORBG}</td>
            <td>{EXTRA_CROP}</td>
            <td>
              <a href="{EXTRA_EDIT}" class="btn btn-default">{PHP.L.Edit}</a>
              <a href="{EXTRA_DELETE}" class="btn btn-danger">{PHP.L.Delete}</a>
            </td>
          </tr>
          <!-- END: LOOP -->
        </tbody>
      </table>
      <!-- END: NAME -->
    </div>
  </div>
  <!-- END: LOCATION -->
<!-- END: INFO -->

<div class="row">
  <div class="col-md-6">
    <form action="{EXTRA_SEND}" method="post" role="form">
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Extra Location</label>
            {EXTRA_INPUT_LOCATION}
          </div>
          <div class="col-md-6">
            <label>Extra Name</label>
            {EXTRA_INPUT_NAME}
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Thumbnail Unique Name</label>
            {EXTRA_INPUT_THNAME}
          </div>
          <div class="col-md-6">
            <label>Thumbnail Crop</label>
            {EXTRA_INPUT_CROP}
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Thumbnail X</label>
            <div class="input-group">
              {EXTRA_INPUT_X}
              <span class="input-group-addon">px</span>
            </div>
          </div>
          <div class="col-md-6">
            <label>Thumbnail Y</label>
            <div class="input-group">
              {EXTRA_INPUT_Y}
              <span class="input-group-addon">px</span>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Thumbnail JPG Quality</label>
            {EXTRA_INPUT_JPG_QUALITY}
          </div>
          <div class="col-md-6">
            <label>Thumbnail Color Background</label>
            {EXTRA_INPUT_COLORBG}
          </div>
        </div>
      </div>
      <!-- BEGIN: ADD -->
      <input type="submit" class="btn btn-primary" name="submit" value="{PHP.L.Submit}">
      <!-- END: ADD -->
      <!-- BEGIN: EDIT -->
      <input type="submit" class="btn btn-primary" name="submit" value="{PHP.L.Edit}">
      <!-- END: EDIT -->
    </form>
  </div>
</div>
<!-- END: MAIN -->
