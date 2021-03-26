<script type="text/javascript">

 $(document).ready(function(){

    $('#example').DataTable({  
      "order": [[ 0, "desc" ]],
          "columnDefs":[
          {
            "targets":[1],
            "orderable":false,
          },
        ],
        "pageLength": 100
        });
  });

</script>

  </div>


<script src="../resources/js/basic.js"></script> 

<script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script> 
<script src="../vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="../vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="dist/js/form-advance-data.js"></script>
<script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script> 
<script src="../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
<script src="../vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
<script src="dist/js/sweetalert-data.js"></script>
<script src="../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/responsive-datatable-data.js"></script>
     
     <script src="dist/js/dataTables-data.js"></script>

    <script src="dist/js/jquery.slimscroll.js"></script>

    <script src="../vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

    <script src="../vendors/bower_components/switchery/dist/switchery.min.js"></script>

    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <script src="dist/js/init.js"></script>

    <script src="../vendors/bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="dist/js/bootstrap-table-data.js"></script>
    

    <script src="../vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="../vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="../vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="../vendors/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../vendors/vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <script src="../vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/vectormap-data.js"></script>
    <script src="../vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    <script src="../vendors/bower_components/peity/jquery.peity.min.js"></script>
    <script src="dist/js/peity-data.js"></script>
    <script src="../vendors/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="../vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="../vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="../vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    <script src="../vendors/chart.js/Chart.min.js"></script>
    <script src="dist/js/dashboard-data.js"></script>

 <script src="../vendors/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    
        <script src="../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
     
        <script src="../vendors/bower_components/dropify/dist/js/dropify.min.js"></script>
        <script src="dist/js/form-file-upload-data.js"></script>
      
        <script type="text/javascript" src="../vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
        <script src="../vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script type="text/javascript" src="../vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script src="../vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="dist/js/form-picker-data.js"></script>
 
        <script type="text/javascript" src="../vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
      
        <script src="../vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
        
        <script src="../vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="../vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="../vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
        <script src="../vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>
        
        <script src="../vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
        <script src="dist/js/form-advance-data.js"></script>
   
 
 
    <script type="text/javascript">
        var specialKeys = new Array();
      
        specialKeys.push(8); //Backspace
        specialKeys.push(9); //Tab
        specialKeys.push(46); //Delete
        specialKeys.push(36); //Home
        specialKeys.push(35); //End
        specialKeys.push(37); //Left
        specialKeys.push(39); //Right
        specialKeys.push(92); //\| 


        function specialcharacternotallowed(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
           // document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
    </script> 




       <script type="text/javascript">
        function ClearFields()  {

           document.getElementById("itemcode1").value = "";
           document.getElementById("item_name1").value = "";
           document.getElementById("units1").value = "";
           document.getElementById("pendingqty1").value = "";
           document.getElementById("packing1").value = "";
           document.getElementById("order_item_price1").value = "";
           document.getElementById("order_item_quantity1").value = "";
           document.getElementById("order_item_actual_amount1").value = "";
           document.getElementById("foc1").value = "";

  

            }
      </script>

  <script type="text/javascript">
        function ClearFieldssofpurchasereceipt()  {

           document.getElementById("itemcode1").value = "";
           document.getElementById("item_name1").value = "";
           document.getElementById("units1").value = "";
           document.getElementById("packing1").value = "";
           document.getElementById("order_item_price1").value = "";
           document.getElementById("order_item_quantity1").value = "";
           document.getElementById("order_item_actual_amount1").value = "";
           document.getElementById("foc1").value = "";
            document.getElementById("batchno1").value = "";
            document.getElementById("manufacturedate1").value = "";
             document.getElementById("expirydate1").value = "";
           

    

            } 


                function ClearFieldssales()  {

           document.getElementById("itemcode1").value = "";
           document.getElementById("item_name1").value = "";
           document.getElementById("units1").value = "";
           document.getElementById("packing1").value = "";
           document.getElementById("order_item_price1").value = "";
           document.getElementById("order_item_quantity1").value = "";
           document.getElementById("order_item_actual_amount1").value = "";
           document.getElementById("foc1").value = "";
             document.getElementById("disprice1").value = "";
             document.getElementById("order_item_final_amount1").value = "";
            document.getElementById("extrabonus1").value = "";
                document.getElementById("expirydate1").value = "";
             
}




      </script>



    
<script type="text/javascript">


  (function timeAgo(selector) {

    var templates = {
        prefix: "",
        suffix: " ago",
        seconds: "less than a minute",
        minute: "about a minute",
        minutes: "%d minutes",
        hour: "about an hour",
        hours: "about %d hours",
        day: "a day",
        days: "%d days",
        month: "about a month",
        months: "%d months",
        year: "about a year",
        years: "%d years"
    };
    var template = function (t, n) {
        return templates[t] && templates[t].replace(/%d/i, Math.abs(Math.round(n)));
    };

    var timer = function (time) {
        if (!time) return;
        time = time.replace(/\.\d+/, ""); // remove milliseconds
        time = time.replace(/-/, "/").replace(/-/, "/");
        time = time.replace(/T/, " ").replace(/Z/, " UTC");
        time = time.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2"); // -04:00 -> -0400
        time = new Date(time * 1000 || time);

        var now = new Date();
        var seconds = ((now.getTime() - time) * .001) >> 0;
        var minutes = seconds / 60;
        var hours = minutes / 60;
        var days = hours / 24;
        var years = days / 365;

        return templates.prefix + (
        seconds < 45 && template('seconds', seconds) || seconds < 90 && template('minute', 1) || minutes < 45 && template('minutes', minutes) || minutes < 90 && template('hour', 1) || hours < 24 && template('hours', hours) || hours < 42 && template('day', 1) || days < 30 && template('days', days) || days < 45 && template('month', 1) || days < 365 && template('months', days / 30) || years < 1.5 && template('year', 1) || template('years', years)) + templates.suffix;
    };

    var elements = document.getElementsByClassName('timeago');
    for (var i in elements) {
        var $this = elements[i];
        if (typeof $this === 'object') {
            $this.innerHTML = timer($this.getAttribute('title') || $this.getAttribute('datetime'));
        }
    }
    // update time every minute
    setTimeout(timeAgo, 60000);

})();
</script>
