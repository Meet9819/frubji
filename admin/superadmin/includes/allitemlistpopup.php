
   <div id="item-data-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h5 class="modal-title">Search Box [Items Available]</h5>
          </div>
          <div class="modal-body">
            <div class="table-wrap">
              <div class="bootstrap-table">
                  <div class="fixed-table-container">
                    <div class="fixed-table-body">
                      <table style="border-spacing: 1px;">
                        <tbody>
                          <tr>
                            <td>Item Code:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="0">
                            </td>
                            <td>Item Name:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="1">
                            </td>
                          </tr>
                          <tr>
                            <td>Max Packing:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="2">
                            </td>
                            <td>Main Group:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="3">
                            </td>
                          </tr>
                          <tr>
                            <td>Group:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="4">
                            </td>
                            <td>Subgroup:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="5">
                            </td>
                          </tr>
                          <tr>
                            <td>Wholesale Price:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="6">
                            </td>
                            <td>Retail Group:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="7">
                            </td>
                          </tr>
                          <tr>
                            <td>Manufacturer:</td>
                            <td>
                              <input type="text" value="" class="data-table-search" data-column-index="8">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <table id="modal-data-table" data-toggle="table" class="table table-hover">
                        <thead>
                          <tr>
                            <th tabindex="0">Code</th>
                            <th tabindex="0">Name</th>
                            <th tabindex="0">Max Packing</th>
                            <th tabindex="0">Main Group</th>
                            <th tabindex="0">Group</th>
                            <th tabindex="0">Sub Group</th>
                            <th tabindex="0">WS Price</th>
                            <th tabindex="0">RS Price</th>
                            <th tabindex="0">Man.</th>
                            <th tabindex="0">Stock (pcs)</th>
                          </tr>
                        </thead>
                        <tbody id="item-modal-table-body"></tbody>
                        <tfoot>
                          <tr>
                            <th tabindex="0">Code</th>
                            <th tabindex="0">Name</th>
                            <th tabindex="0">Max Packing</th>
                            <th tabindex="0">Main Group</th>
                            <th tabindex="0">Group</th>
                            <th tabindex="0">Sub Group</th>
                            <th tabindex="0">WS Price</th>
                            <th tabindex="0">RS Price</th>
                            <th tabindex="0">Man.</th>
                            <th tabindex="0">Stock (pcs)</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<script>
window.onload = function()  {
  // Event listener to the filtering inputs to redraw on input
  $(".data-table-search").on("keyup change",function() {
    $("#modal-data-table").DataTable().search("");
    $("#modal-data-table").DataTable().column($(this).data("columnIndex")).search(this.value).draw();
  });

  $(".dataTables_filter input").on("keyup change", function() {
    $("#modal-data-table").DataTable().columns().search('');
    $('.filter').val('');
  });

}
</script>
