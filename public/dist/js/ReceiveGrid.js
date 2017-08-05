
$( document ).ready(function() {
   
    var dop= $('select#PRCODE option:selected').val();
	//console.log(dop);
	LoadReceiveDeclearGrid(dop);
});
function LoadReceiveDeclearGrid(Masterid){
	$(function() {
	//var test='/datalist/BudgetHead.php/index.php/?option=dislike&title='+Masterid;
	//console.log(e);
	
	$.ajax({
        type: "GET",
        //url: "/datalist/Rec_Detail_Item.php"
		url: '/datalist/Rec_Pr_Code.php?id='+Masterid
		}).done(function(Rec_RD_Code){
			
			Rec_RD_Code.unshift({ pr_req_no: "0", asset_name: "Select"});
			
    $.ajax({
        type: "GET",
        //url: "/datalist/Rec_Detail_Item.php"
		url: '/datalist/Rec_Detail_Item.php?id='+Masterid
		}).done(function(Rec_Detail_Item) {
        Rec_Detail_Item.unshift({ suba_id: "0", suba_name: ""});
		var MyDateField = function (config) {
       jsGrid.Field.call(this, config);};
//date modify
MyDateField.prototype = new jsGrid.Field({sorter: function (date1, date2) {
            return new Date(date1) - new Date(date2);
        },
       
        itemTemplate: function (value) {
			
           // debugger;
            return new Date(value).getFullYear();
        },

        insertTemplate: function (value) {
            return this._insertPicker = $("<input>").datepicker({
               
    
	 autoclose: true
            });
        },

        editTemplate: function (value) {
            return $("<input>").datepicker({
                
	 autoclose: true
            }).datepicker('update',new Date(value));
        },
       
        insertValue: function () {
            return this._insertPicker.datepicker({
               
	 autoclose: true
            }).val();
        },
       
         editValue: function () {
			 
            //return this._editPicker.datepicker({
             //  // format: 'MM/DD/YYYY'
            //}).val();
			return "2017";
			
        }
    });
	
	jsGrid.fields.myDateField = MyDateField;
        $("#jsRecGrid").jsGrid({
            height: "auto",
            width: "100%",
            filtering: true,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete client?",
            controller: {
               loadData: function(filter) {
					//console.log("IN");
					console.log('/datalist/ReceiveData/index.php?option=dislike&title='+Masterid);
                    return $.ajax({
                        type: "GET",
                        url: '/datalist/ReceiveData/index.php?option=dislike&title='+Masterid,
                        //url: "/datalist/ReceiveData/",
                        data: filter
					});
					
				},
                insertItem: function(item) {
					console.log("IN");
                    return $.ajax({
                        type: "POST",
                        url: '/datalist/ReceiveData/index.php?option=dislike&title='+Masterid,
                        data: item,
						success:function(data2) {
						console.log(data2); 
						}

					});
					console.log(item);
				},
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: '/datalist/ReceiveData/index.php?option=dislike&title='+Masterid,
                        data: item,
						success:function(data2) {
						console.log(data2); 
						}
					});
				},
                deleteItem: function(item) {
					console.log(Masterid);
                    return $.ajax({
                        type: "DELETE",
                        url: '/datalist/ReceiveData/index.php?option=dislike&title='+Masterid,
                        data: item
					});
				}
			},
			
            fields: [
			
				{ name: "RD_NO",title: "Receive Detail ID", type: "number", width: 50,filtering: false},
				{ name: "RD_RM_NO",title: "Item Name", type: "select", items: Rec_RD_Code, valueField: "pr_req_no", textField: "asset_name" },
				{ name: "RD_ITEM_CODE",title: "PR Name", type: "select", items: Rec_Detail_Item, valueField: "suba_id", textField: "suba_name" },
				{ name: "RD_PART_NO",title: "Parts No", type: "text", width: 100,filtering: false},
				
				{ name: "RD_BATCH_NO",title: "Batch No", type: "text", width: 100,filtering: false, validate: "required"},
				{ name: "RD_QTY",title: "Quantity", type: "number", width: 50,filtering: false},
				{ name: "RD_EXP_DATE",myCustomProperty: "bar", title: "Receive Date", type: "myDateField", width: 100,filtering: false },
				{ type: "control" }
			]
			
		});
		
	});
		});
	
});

}
