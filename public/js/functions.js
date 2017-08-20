/*
 * Custom made jQuery | Ajax functions
 * 
 */


/*
 * jQuery Data Tables function
 */
$(document).ready(function() {
    $('#dataTables-function').DataTable({
        responsive: true,
        "pageLength": 50,
        "aaSorting": [[ 0, "desc" ]] // Sort by first column descending
    });
});

/*
 * jQuery Data Tables function
 */
$(document).ready(function() {
    $('#dataTables-function1').DataTable({
        responsive: true,
        "pageLength": 50,
        "aaSorting": [[ 0, "desc" ]] // Sort by first column descending
    });
});

/*
 * jQuery Data Tables function
 */
$(document).ready(function() {
    $('#dataTables-function2').DataTable({
        responsive: true,
        "pageLength": 50,
        "aaSorting": [[ 0, "desc" ]] // Sort by first column descending
    });
});

/*
 * jQuery Data Tables function
 */
$(document).ready(function() {
    $('#dataTables-function3').DataTable({
        responsive: true,
        "pageLength": 50,
        "aaSorting": [[ 0, "desc" ]] // Sort by first column descending
    });
});


/*
 * Add Estimate get vehicle by customer Ajax function
 */
$('#customer').change(function(e) {
   // console.log(e);
    
    var cust_id = e.target.value;
    
    //ajax
    $.get('/ajax-vehicle?cust_id=' + cust_id, function(data){
        //success data
        //console.log(data);
        $('#vehicle').empty();
        $('#vehicle').append('<option value="">Select a vehicle</option>');
        $.each(data, function(index, vehicleObj){
            $('#vehicle').append('<option value="'+vehicleObj.id+'">'+vehicleObj.reg_no+'</option>');
        });
    });
});




/**
 *
 *
 * Dynamic form table row populate new function
 */
/*
var i = 1;
$("#addRow").click(function() {
    $("table tr:last").clone().find(":input").each(function() {
        $("#item_id" + i).val('').trigger("liszt:updated");
        $(this).val('').attr('id', function(_, id) { return id + i });
    }).end().appendTo("table");
    i++;
});
*/
/*
$('#dynamic-tbl').on('click',"select[name='item_id[]']",function(e){
    $(this).chosen({no_results_text: "Oops, nothing found!"});
});*/

/* *********************************************************** */
var i = 1;
$("#addRow").click(function() {
    $("table tr:last").clone().find(":input").each(function() {
        $("#item_id" + i).val('').trigger("liszt:updated");
        $(this).val('').attr('id', function(_, id) { return id + i });
        $(this).prop('disabled', false);
        $(this).prop('readonly', false);
    }).end().appendTo("table");
    i++;
    /*$("table tr:last").find("select[name='item_id[]']").chosen({no_results_text: "Oops, nothing found!"});*/
});

   /* *********************************************************** */

/*
$("#dynamic-tbl").on('click', 'select', function(e){
    var item_id = e.target.value;
    var self = this;
    $(self).val('').trigger("liszt:updated");
    //ajax
    $.get('/ajax-items', function(data){
        //success data
        //console.log(data);
        $(self).empty();
        $(self).append('<option value="">Select an item</option>');
        $.each(data, function(index, itemObj){
            $(self).append('<option value="'+itemObj.id+'">'+itemObj.name+'</option>');
        });
        //$(self).chosen();
    });
});
*/

/*
 *
 * All chosen library individuals
 */
$(".customer-select").chosen({no_results_text: "Oops, nothing found!"});
$(".itemIdFirst").chosen({no_results_text: "Oops, nothing found!"});
$(".estimateEditItem").chosen();

var i = 1;
$("#addEstimateRow").click(function() {
    $.get('/ajax-items', function(data){
        $("table").append("<tr>" +
            "<td><select class='form-control itemId' id='item_id' required='required' name='item_id[]'><option value='' selected='selected'>Select an item</option></select></td>" +
            "<td><input class='form-control item_description' id='item_description' placeholder='Not Required | Optional' required='required' name='item_description[]' type='text'></td>" +
            "<td><input class='form-control units' placeholder='Add Number' id='units' required='required' name='units[]' type='text'></td>" +
            "<td><input class='form-control rate' placeholder='Add Rate' id='rate' required='required' name='rate[]' type='text'></td>" +
            "<td><input class='form-control amount' id='amount' placeholder='Add Hrs and Rate' required='required' name='amount[]' type='text'></td>" +
            "<td class='text-center actions'><a id='delete-row' href='#'><i class='fa fa-times'></i></a></td>" +
            "</tr>");
        $("table tr:last").find(":input").each(function() {
            $("#item_id" + i).val('').trigger("liszt:updated");
            $(this).val('').attr('id', function (_, id) {
                return id + i
            });
        });
        var self = this;
        $.each(data, function(index, itemObj){
            $("#item_id" + i).append('<option value="'+itemObj.id+'">'+itemObj.name+'</option>');
        });
        $("#item_id" + i).chosen({no_results_text: "Oops, nothing found!"});

    });

    i++;
});


var i = 1;
$("#addEditEstimateRow").click(function() {

    $.get('/ajax-items', function(data){
        //console.log(data);

        $('tbody').append('<tr>' +
            '<td><select class="form-control itemId estimateEditItem" id="item_id" required="required" name="item_id[]"><option value="" selected="selected">Select an item</option></select></td>' +
            '<td><input class="form-control item_description" id="item_description" placeholder="Item Description" required="required" name="item_description[]" type="text"></td>' +
            '<td><input class="form-control units" placeholder="Add Number" id="units" required="required" name="units[]" type="text"></td>' +
            '<td><input class="form-control rate" placeholder="Add Rate" id="rate" required="required" name="rate[]" type="text"></td>' +
            '<td><input class="form-control amount" id="amount" placeholder="Add Hrs and Rate" required="required" name="amount[]" type="text"></td>' +
            '<td><input class="form-control approved_amount" id="approved_amount" placeholder="Approved Amount" name="approved_amount[]" type="text"></td>' +
            '<td class="text-center actions"><a id="delete-row" href="#"><i class="fa fa-times"></i></a></td>' +
            '</tr>');

        /*
        $("table tr:last").find(":input").each(function() {
            $("#item_id" + i).val('').trigger("liszt:updated");
            $(this).val('').attr('id', function (_, id) {
                return id + i
            });
        });
        var self = this;
        */
        $.each(data, function(index, itemObj){
            $(".estimateEditItem").append('<option value="'+itemObj.id+'">'+itemObj.name+'</option>');
        });
        $(".estimateEditItem").chosen({no_results_text: "Oops, nothing found!"});

    });

    i++;
});

/*
$('#addinput').click(function(){
    $("form").append('<input type="text" name="testInput" value="999999999">');
});
*/

var i = 1;
$("#addOrderRow").click(function() {
    $.get('/ajax-items', function(data){
        $("table").append("<tr>" +
            "<td><select class='form-control itemId' id='item_id' required='required' name='item_id[]'><option value='' selected='selected'>Select an item</option></select></td>" +
            "<td><input class='form-control item_description' id='item_description' placeholder='Item Description' required='required' name='item_description[]' type='text'></td>" +
            "<td><input class='form-control' placeholder='Add Quantity' id='quantity' required='required' name='quantity[]' type='text'></td>" +
            "<td><input class='form-control price' placeholder='Add Price' id='price' required='required' name='price[]' type='text'></td>" +
            "<td class='text-center actions'><a id='delete-row' href='#'><i class='fa fa-times'></i></a></td>" +
            "</tr>");
        $("table tr:last").find(":input").each(function() {
            $("#item_id" + i).val('').trigger("liszt:updated");
            $(this).val('').attr('id', function (_, id) {
                return id + i
            });
        });
        var self = this;
        $.each(data, function(index, itemObj){
            $("#item_id" + i).append('<option value="'+itemObj.id+'">'+itemObj.name+'</option>');
        });
        $("#item_id" + i).chosen({no_results_text: "Oops, nothing found!"});

    });

    i++;
});

var i = 1;
$("#addInvoiceRow").click(function() {
    $.get('/ajax-items', function(data){
        $("table").append("<tr>" +
            "<td><select class='form-control itemId' id='item_id' required='required' name='item_id[]'><option value='' selected='selected'>Select an item</option></select></td>" +
            "<td><input class='form-control item_description' id='item_description' placeholder='Not Required | Optional' required='required' name='item_description[]' type='text'></td>" +
            "<td><input class='form-control units' placeholder='Add Number' id='units' required='required' name='units[]' type='text'></td>" +
            "<td><input class='form-control rate' placeholder='Add Rate' id='rate' required='required' name='rate[]' type='text'></td>" +
            "<td><input class='form-control amount' id='amount' placeholder='Add Hrs and Rate' required='required' name='amount[]' type='text'></td>" +
            "<td class='text-center actions'><a id='delete-row' href='#'><i class='fa fa-times'></i></a></td>" +
            "</tr>");
        $("table tr:last").find(":input").each(function() {
            $("#item_id" + i).val('').trigger("liszt:updated");
            $(this).val('').attr('id', function (_, id) {
                return id + i
            });
        });
        var self = this;
        $.each(data, function(index, itemObj){
            $("#item_id" + i).append('<option value="'+itemObj.id+'">'+itemObj.name+'</option>');
        });
        $("#item_id" + i).chosen({no_results_text: "Oops, nothing found!"});

    });

    i++;
});


/*
 * Dynamic table row adding and deleting functions
 */
/*
function addTableRow(jQtable){
    var rowId = parseInt($('#dynamic-tbl tbody tr:last').attr('id'));
    ++rowId;
   // console.log(rowId);
	jQtable.each(function(){
		var tds = '<tr id='+rowId+'>';
		jQuery.each($('tr:last td', this), function() {tds += '<td>'+$(this).html()+'</td>';});
		tds += '</tr>';
		if($('tbody', this).length > 0){$('tbody', this).append(tds);
		}else {$(this).append(tds);}
	});
}
*/
$(function(){
	$('table').on('click','#delete-row',function(e){
	   e.preventDefault();
	  $(this).parents('tr').remove();

      var sum = 0;
      $(".amount").each(function(){
          sum += +$(this).val();
      });
      $(".total").val(sum);

	});
});


$("#dynamic-tbl").on('change', 'select', function(e){
    var item_id = e.target.value;
    var self = this;
    //ajax
    $.get('/ajax-item?item_id=' + item_id, function(data){
        //success data
        //console.log(data);
        $.each(data, function(index, itemObj){
            $(self) // use self not this
                .closest('tr') // get the parent(closest) tr
                .find('input[name="item_description[]"]')// now find the item_description by name as id must be unique
                .val(itemObj.name);
            $(self)
                .closest('tr')
                .find('input[name="rate[]"]')
                .val(itemObj.sale_price);
            var amount = $(self).closest('tr').find('input[name="units[]"]').val() * $(self).closest('tr').find('input[name="rate[]"]').val();
            $(self).closest('tr').find('input[name="amount[]"]').val(amount);
            $(self).closest('tr').find('input[name="approved_amount[]"]').val(amount);
        });
    });
    var sum = 0;
    $('input[name="approved_amount[]"]').each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});


$("#dynamic-tbl").on('change', 'input[name="units[]"]', function(e){
    var units = e.target.value;
    var self = this;
    var rate = $(self).closest('tr').find('input[name="rate[]"]').val();
    var ammount = (units*rate).toFixed(2);
    $(self).closest('tr').find('input[name="amount[]"]').val(ammount);
    $(self).closest('tr').find('input[name="approved_amount[]"]').val(ammount);

    var sum = 0;
    $(".amount").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});

$("#dynamic-tbl").on('change', 'input[name="rate[]"]', function(e){
    var units = e.target.value;
    var self = this;
    var rate = $(self).closest('tr').find('input[name="units[]"]').val();
    var ammount = (units*rate).toFixed(2);
    $(self).closest('tr').find('input[name="amount[]"]').val(ammount);
    $(self).closest('tr').find('input[name="approved_amount[]"]').val(ammount);

    var sum = 0;
    $(".amount").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});

$("#dynamic-tbl").on('change', 'input[name="amount[]"]', function(e){
    var amount = e.target.value;
    $(this).closest('tr').find('input[name="approved_amount[]"]').val(amount);
    var sum = 0;
    $(".amount").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});


function calcTotal() {
    var sum = 0;
    $(".amount").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
}


/**
 *
 * Purchase Order Create table functions
 */
$("#dynamic-tbl").on('change', 'input[name="price[]"]', function(e){
    var sum = 0;
    $(".price").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});

function calcOrderTotal(){
    var sum = 0;
    $(".price").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
}

/*
 *
 * Approved Amount field change function
 */
$("#dynamic-tbl").on('change', 'input[name="approved_amount[]"]', function(e){
    var units = e.target.value;
    var self = this;
    /*$(self).closest('tr').find('select[name="item_id[]"]').prop('disabled', true);*/
    $(self).closest('tr').find('input[name="units[]"]').prop('readonly', true);
    $(self).closest('tr').find('input[name="rate[]"]').prop('readonly', true);
    $(self).closest('tr').find('input[name="amount[]"]').prop('readonly', true);

    var sum = 0;
    $('input[name="approved_amount[]"]').each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});


/*
 *
 * Estimate on submit form validation
 */
$(document).ready(function(){
    $("#estimate-create-form").submit(function(){
        if ($.trim($("#customer").val()) === "") {
            $("#estimate-form-errors-inner").remove();
            $("#estimate-form-errors").append("<div class='alert alert-danger' id='estimate-form-errors-inner'><ul><li>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Customer must not be empty" +
                "</li></ul></div>");
            return false;
        }
        if($.trim($("#vehicle").val()) === ""){
            if($.trim($("#vehicle-reg").val()) === "") {
                $("#estimate-form-errors-inner").remove();
                $("#estimate-form-errors").append("<div class='alert alert-danger' id='estimate-form-errors-inner'><ul><li>" +
                    "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Vehicle or Registration No Required" +
                    "</li></ul></div>");
                return false;
            }else{
                return true;
            }
        }
        if ($.trim($("#department").val()) === "") {
            $("#estimate-form-errors-inner").remove();
            $("#estimate-form-errors").append("<div class='alert alert-danger' id='estimate-form-errors-inner'><ul><li>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Department cannot be empty" +
                "</li></ul></div>");
            return false;
        }
        if ($.trim($("#estimate-type").val()) === "") {
            $("#estimate-form-errors-inner").remove();
            $("#estimate-form-errors").append("<div class='alert alert-danger' id='estimate-form-errors-inner'><ul><li>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Estimate Type cannot be empty" +
                "</li></ul></div>");
            return false;
        }
        if ($.trim($("#mileage_in").val()) === "") {
            $("#estimate-form-errors-inner").remove();
            $("#estimate-form-errors").append("<div class='alert alert-danger' id='estimate-form-errors-inner'><ul><li>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mileage in cannot be empty" +
                "</li></ul></div>");
            return false;
        }


        var flag = false;
        $('.itemId').filter(function() {
            if (this.value != '') {
                flag = true;
                //no need to iterate further
                return false;
            }
        });

        if (!flag) {
            $("#estimate-form-errors").append("<div class='alert alert-danger' id='estimate-form-errors-inner'><ul><li>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Item cannot be empty" +
                "</li></ul></div>");
            return false;
        }

        /*
        if ($.trim($('select[name="item_id[]"]').val()) === "" || $.trim($('input[name="item_description[]"]').val()) === "" || $.trim($('input[name="units[]"]').val()) === "" || $.trim($('input[name="rate[]"]').val()) === "" || $.trim($('input[name="amount[]"]').val()) === "") {
            $("#estimate-form-errors-inner").remove();
            $("#estimate-form-errors").append("<div class='alert alert-danger' id='estimate-form-errors-inner'><ul><li>" +
                "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Item data cannot be empty" +
                "</li></ul></div>");
            return false;
        }*/
    });
});


/*
 *
 * Date picker for create job form
 */
$(function () {
    $('#promised-date').datepicker({
        viewMode: 'years',
        format: "yyyy/mm/dd",
        autoclose: true,
        todayHighlight: true
    });
    $('#date-pick1').datepicker({
        viewMode: 'years',
        format: "yyyy/mm/dd",
        autoclose: true,
        todayHighlight: true
    });
    $('#date-pick2').datepicker({
        viewMode: 'years',
        format: "yyyy/mm/dd",
        autoclose: true,
        todayHighlight: true
    });
});

/*
$(document).ready(function() {
    $(".js-example-basic-single").select2();
});
*/
//$("#dynamic-tbl").on('change', 'input[name="item_id[]"]', function(){
/**
$(document).ready(function() {
    $('[id="item_id"]').select2();
});
 */
/*
$("#dynamic-tbl").on('change', 'select', function(e){
    //var select_id = e.target.id;
    $(e.target.id).select2();
});
*/

/*
$(document).ready(function() {
    //$('#item_id').chosen();
});
*/
/*
$(document).ready(function() {
    $('.grn-create').hide();
    $('.save-grn').hide();
});
*/
$("#grn-supplier").on('change', 'select', function(e){
    var supplier_id = e.target.value;
    var self = this;
    //ajax
    //console.log(supplier_id);
    $.get('/ajax-grn?supplier_id=' + supplier_id, function(data){
        //success data
        //console.log(data);
        $('.grn-create tbody tr').remove();
        $.each(data, function(index, itemObj){
         $('.grn-create').append('<tr>' +
             '<td><select name="order_id[]" class="form-control orderId" readonly><option value="' + itemObj.order_id + '">' + itemObj.order_id + '</option></select></td>' +
             '<td><select name="item_id[]" class="form-control itemId" readonly><option value="' + itemObj.item_id + '">' + itemObj.name + '</option></select></td>' +
             '<td><input type="text" name="item_description[]" class="form-control item_description" readonly value="' + itemObj.item_description + '"></td>' +
             '<td><input type="text" name="quantity[]" readonly class="form-control item_description" value="' + itemObj.qty + '"></td>' +
             '<td><input type="text" name="quantity_in[]" class="form-control quantityIn"></td>' +
             '<input type="hidden" name="order_detail_id[]" value="' + itemObj.order_detail_id + '">' +
             '</tr>');
        });
    });
});

$(".grn-create").on('change', '.quantityIn', function(){
    var qtyIn = parseInt($(this).val(), 10);
    var self = $(this);
    var qty = parseInt($(this).closest('tr').find('input[name="quantity[]"]').val(), 10);
    if(qty < qtyIn){
        self.val('');
    }
});



var i = 2;
$("#addIssueNoteRow").click(function() {
    $("table tr:last").clone().find(":input").each(function() {
        $("#job_id_" + i).val('').trigger("liszt:updated");
        $(this).val('').attr('id', function(_, id) { return id + i });
        $(this).closest('tr').find('select[name="item[]"]').empty();
    }).end().appendTo("table");
    i++;
});

$(document).ready(function() {
    $("#issue-note-wrapper").on('change', 'select', function(e){
        var select_id = e.target.value;
        var self = this;
        if( $(this).attr('id').match(/job_id_/) ) {
            $.get('/ajax_issue_note_job_items?job_id=' + select_id, function(data){
                //console.log(data);
                $(self).closest('tr').find('select[name="item[]"]').empty();
                $(self).closest('tr').find('select[name="item[]"]').append('<option value="">Select an Item</option>');
                $.each(data, function(index, itemsObj){
                    $(self).closest('tr').find('select[name="item[]"]').append('<option value="'+itemsObj.id+'">'+itemsObj.item_description+'</option>');
                });
            });
        } else if($(this).attr('id').match(/issue_note_items_/)){
            var job_id = $(self).closest('tr').find('select[name="job_id[]"]').val();
            $.get('/ajax_issue_note_job_items_qty?detail_id=' + select_id + '&job_id=' + job_id, function(data){
                //console.log(data);
                $(self).closest('tr').find('input[name="quantity_req[]"]').empty();
                $(self).closest('tr').find('input[name="detail_id[]"]').empty();
                $.each(data, function(index, itemObj){
                    $(self).closest('tr').find('input[name="quantity_req[]"]').val(itemObj.balance_quantity);
                    $(self).closest('tr').find('input[name="detail_id[]"]').val(itemObj.id);
                });
            });
        }
    });

});


$("#issue-note-wrapper").on('change', '.quantity_issue', function(){
    var qty_issue = parseInt($(this).val(), 10);
    var self = $(this);
    var qty_req = parseInt($(this).closest('tr').find('input[name="quantity_req[]"]').val(), 10);
    if(qty_req < qty_issue){
        self.val('');
    }
});

/*
*
* Create Invoice Job Select
 */
$("#invoice_create").on('change', 'select', function(e){
    var job_id = e.target.value;
    var self = this;
    //ajax
    //console.log(supplier_id);
    $.get('/ajax-invoice-create?job_id=' + job_id, function(data){
        //success data
        //console.log(data);
        $('#invoice_job_details div').remove();
        $('#invoice_job_total').val('');
        $.each(data, function(index, itemObj){
            $('#invoice_job_details').append('<div id="invoice_job_data">' +
                '<p><strong>Estimate No: </strong># ' + itemObj.est_id + '</p>' +
                '<p><strong>Job No: </strong># ' + itemObj.job_id + '</p>' +
                '<p><strong>Customer Name: </strong>' + itemObj.name + '</p>' +
                '<p><strong>Registration No: </strong>' + itemObj.reg_no + '</p>' +
                '<p><strong>Make: </strong>' + itemObj.make + '</p>' +
                '<p><strong>Model: </strong>' + itemObj.model + '</p>' +
                '<p><strong>Promised Date: </strong>' + itemObj.promised_date + '</p>' +
                '<p><strong>Net Amount: </strong>' + itemObj.grand_total + '</p>' +
                '<p><strong>Remarks: </strong>' + itemObj.remarks + '</p>' +
                '</div>');
            $('#invoice_job_total').val(itemObj.grand_total);
        });
    });
});


$('#report-dates').submit(function() {
    if ($.trim($("#date-pick1").val()) === "" || $.trim($("#date-pick2").val()) === "") {
        $('#submit-alert .alert').remove();
        $('#submit-alert').append('<div class="alert-custom alert alert-danger">' +
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
            'Add two dates' +
            '</div>');
        return false;
    }
});


/*
 *
 * Item VAT NBT checkboxes
 */
$('#checkbox-vat').change( function(){
    if (this.checked) {
        $('#checkbox-vat').val(1);
    }else{
        $('#checkbox-vat').val(0);
        $(this).removeAttr('checked');
    }
});

$('#checkbox-nbt').change( function(){
    if (this.checked) {
        $('#checkbox-nbt').val(1);
    }else{
        $('#checkbox-nbt').val(0);
        $(this).removeAttr('checked');
    }
});

/*
$('#dynamic-tbl').on('click',"select[name='item_id[]']",function(e){
    $(this).chosen({no_results_text: "Oops, nothing found!"});
});

*/


$(document).ready(function() {
    var vat_sum = 0;
    $('.row-vat').each(function(){
        if(!isNaN(parseFloat($(this).text()))){
            vat_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
        }

    });
    $('#vat-total').after("Rs. " + vat_sum.toFixed(2));
});

$(document).ready(function() {
    var nbt_sum = 0;
    $('.row-nbt').each(function(){
        if(!isNaN(parseFloat($(this).text()))){
            nbt_sum += parseFloat($(this).text());  //Or this.innerHTML, this.innerText
        }

    });
    $('#nbt-total').after("Rs. " + nbt_sum.toFixed(2));
});




$('#quick-add-customers').submit(function(){
    if ($.trim($("#customer-name").val()) === "" || $.trim($("#customer-address").val()) === "" || $.trim($("#quick-vehicle-reg").val()) === "" || $.trim($("#quick-vehicle-make").val()) === "" || $.trim($("#quick-vehicle-model").val()) === "") {
        $('#submit-alert .alert').remove();
        $('#submit-alert-customer').append('<div class="alert-custom alert alert-danger">' +
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
            'Add All Customer and Vehicle Data' +
            '</div>');
        return false;
    }
});

$("#quick-item-btn").click(function(){
    $('.ajax-alert').remove();
    $('#quick-add-item-name').val("");
    $('#quick-add-item-price').val("");
    $('#quick-add-item-type').val("");
});

$('#save-quick-item').click(function(e){
    e.preventDefault();	
    if ($.trim($("#quick-add-item-name").val()) === "" || $.trim($("#quick-add-item-price").val()) === "" || $("#quick-add-item-type").val() == "") {
        $('#submit-alert .alert').remove();
        $('#submit-alert-item').append('<div class="alert-custom alert alert-danger">' +
            '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
            'Add All Item Data' +
            '</div>');
        return false;
    }else {
        var itemName = $.trim($("#quick-add-item-name").val());
        var itemPrice = $.trim($("#quick-add-item-price").val());
        var itemType = $.trim($("#quick-add-item-type").val());
        var itemVat = $("input[name='vat']:checked").val();
        var itemNbt = $("input[name='nbt']:checked").val();
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            url: '/quick-add-item',
            data: {'_token': $('input[name=_token]').val(), name: itemName, type: itemType, sale_price: itemPrice, vat: itemVat, nbt: itemNbt},
            success: function (data) {
                if(data.item_id != null){
                    $('.ajax-alert').remove();
                    $('#quick-add-item-model-body').append('<div class="ajax-alert alert alert-success">' +
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                        '<strong>New Item Saved!</strong>' +
                        '</div>');
                }else{
                    $('.ajax-alert').remove();
                    $('#quick-add-item-model-body').append('<div class="ajax-alert alert alert-danger">' +
                        '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                        '<strong>Something went wrong. please try again!</strong>' +
                        '</div>');
                }
            },

        })
    }
    return false;
});



/*
 *
 * New Job invoice save table checkbox functions for NBT and VAT
 */

$("#invoice-save-wrapper").on('change', 'input[name="nbt[]"]', function(e){
    var self = this;
    var nbtValue = parseFloat($('#nbtValue').text());
    var vatValue = parseFloat($('#vatValue').text());
    var amount = parseFloat($(self).closest('tr').find('.line-amount-fixed').text());
    var vatStatus = $(self).closest('tr').find('input[name="vat[]"]:checked').length > 0;
    if(this.checked) {
        if(vatStatus){
            var newAmountNBT  = parseFloat(( amount + (amount * nbtValue / 100) ).toFixed(2));
            var newAmountNbtVat = ( newAmountNBT + ( newAmountNBT * vatValue / 100) ).toFixed(2);
            $(self).closest('tr').find('.invoice-nbt-check').val('1');
            $(self).closest('tr').find('.invoice-vat-check').val('1');
            $(self).closest('tr').find('.line-amount').text(newAmountNbtVat);
        }else{
            var newAmountNBT  = ( amount + (amount * nbtValue / 100) ).toFixed(2);
            $(self).closest('tr').find('.invoice-nbt-check').val('1');
            $(self).closest('tr').find('.line-amount').text(newAmountNBT);
        }
    }else{
        if(vatStatus){
            var newAmountVAT  = ( amount + (amount * vatValue / 100) ).toFixed(2);
            $(self).closest('tr').find('.invoice-nbt-check').val('0');
            $(self).closest('tr').find('.invoice-vat-check').val('1');
            $(self).closest('tr').find('.line-amount').text(newAmountVAT);
        }else{
            $(self).closest('tr').find('.invoice-nbt-check').val('0');
            $(self).closest('tr').find('.invoice-vat-check').val('0');
            $(self).closest('tr').find('.line-amount').text(amount.toFixed(2));
        }
    }
});

$("#invoice-save-wrapper").on('change', 'input[name="vat[]"]', function(e){
    var self = this;
    var nbtValue = parseFloat($('#nbtValue').text());
    var vatValue = parseFloat($('#vatValue').text());
    var amount = parseFloat($(self).closest('tr').find('.line-amount-fixed').text());
    var nbtStatus = $(self).closest('tr').find('input[name="nbt[]"]:checked').length > 0;
    if(this.checked) {
        if(nbtStatus){
            var newAmountNBT  = parseFloat(( amount + (amount * nbtValue / 100) ).toFixed(2));
            var newAmountNbtVat = ( newAmountNBT + ( newAmountNBT * vatValue / 100) ).toFixed(2);
            $(self).closest('tr').find('.invoice-nbt-check').val('1');
            $(self).closest('tr').find('.invoice-vat-check').val('1');
            $(self).closest('tr').find('.line-amount').text(newAmountNbtVat);
        }else{
            var newAmountVAT  = ( amount + (amount * vatValue / 100) ).toFixed(2);
            $(self).closest('tr').find('.invoice-vat-check').val('1');
            $(self).closest('tr').find('.line-amount').text(newAmountVAT);
        }
    }else{
        if(nbtStatus){
            var newAmountNBT  = ( amount + (amount * nbtValue / 100) ).toFixed(2);
            $(self).closest('tr').find('.invoice-nbt-check').val('1');
            $(self).closest('tr').find('.invoice-vat-check').val('0');
            $(self).closest('tr').find('.line-amount').text(newAmountNBT);
        }else{
            $(self).closest('tr').find('.invoice-nbt-check').val('0');
            $(self).closest('tr').find('.invoice-vat-check').val('0');
            $(self).closest('tr').find('.line-amount').text(amount.toFixed(2));
        }
    }
});



/*
 *
 * Dashboard widgets start from here
 */
 
 /*
jQuery(document).ready(function ($) {

    // get page name
    var page = $('#system_status').data('page');
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    // check if page is dashboard
    if(page == 'dashboard'){
        //console.log('test_pass');
        function get_fb(){
            var feedback = $.ajax({
                type: "POST",
                data: {_token: CSRF_TOKEN},
                url: "system-status",
                dataType: 'JSON',
                async: false
            }).complete(function(){
                setTimeout(function(){get_fb();}, 10000);
            }).responseText;

            var system_data = JSON.parse(feedback);

            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Label', 'Value'],
                    ['Memory', system_data.memory],
                    ['CPU 1', system_data.cpu[0]],
                    ['CPU 2', system_data.cpu[1]],
                    ['CPU 3', system_data.cpu[2]],
                    ['CPU 4', system_data.cpu[3]]
                ]);

                var options = {
                    width: 600, height: 120,
                    redFrom: 90, redTo: 100,
                    yellowFrom:75, yellowTo: 90,
                    minorTicks: 5
                };
                var chart = new google.visualization.Gauge(document.getElementById('system_status'));

                chart.draw(data, options);

                setInterval(function() {
                    data.setValue(0, 1, system_data.memory);
                    chart.draw(data, options);
                }, 1300);
            }
        }
        get_fb();
    }
});
*/

/*
 *
 * Following code use to detect if form changed and try to leave page without saving
 */
$(document).ready(function() {
    formmodified=0;
    $('form *').change(function(){
        formmodified=1;
    });
    window.onbeforeunload = confirmExit;
    function confirmExit() {
        if (formmodified == 1) {
            return "New information not saved. Do you wish to leave the page?";
        }
    }
    $("input[type='submit']").click(function() {
        formmodified = 0;
    });
});