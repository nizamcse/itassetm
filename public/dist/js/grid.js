$( document ).ready(function() {
   //console.log( "ready!" );
   $( "#DpBDecType" ).change(function() {
	   var dop= $('select#DpBDecType option:selected').val();
	   console.log(dop);
	   //if(dop!=0){
	   LoadBudgetDeclearGrid(dop);
	   //}
});
});
function LoadBudgetDeclearGrid(Masterid){
	 $(function() {
	//var test='/datalist/BudgetHead.php/index.php/?option=dislike&title='+Masterid;
	//console.log(test);
    $.ajax({
        type: "GET",
        url: "/datalist/BudgetHead.php/?id="+Masterid
		}).done(function(BudgetHead) {
        BudgetHead.unshift({ bhead_id: "0", bhead_name: "" });
		var MyDateField = function (config) {
        jsGrid.Field.call(this, config);
		
    };
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
        $("#jsGrid").jsGrid({
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
					
                    return $.ajax({
                        type: "GET",
                        url: '/datalist/BudgetData/index.php/?option=dislike&title='+Masterid,
                        data: filter
					});
					
				},
                insertItem: function(item) {
					//console.log("IN");
                    return $.ajax({
                        type: "POST",
                        url: '/datalist/BudgetData/index.php/?option=dislike&title='+Masterid,
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
                        url: '/datalist/BudgetData/index.php/?option=dislike&title='+Masterid,
                        data: item,
						success:function(data2) {
						console.log(data2); 
						}
					});
				},
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: '/datalist/BudgetData/index.php/?option=dislike&title='+Masterid,
                        data: item
					});
				}
			},
			
            fields: [
			
				{ name: "BDD_ID",title: "Budget Detail ID", type: "number", width: 50,filtering: false},
				{ name: "BDD_HEAD",title: "Budget Head", type: "select", items: BudgetHead, valueField: "bhead_id", textField: "bhead_name" },
				{ name: "BDD_USD",title: "Budget Amount(USD)", type: "number", width: 100,filtering: false},
				
				{ name: "BDD_BD",title: "Budget Amount (BDT)", type: "number", width: 100,filtering: false, validate: "required"},
				{ name: "BDD_ISSUE_DATE",myCustomProperty: "bar", title: "Budget Issue Date", type: "myDateField", width: 100,filtering: false },
				
				{ name: "BDD_QTY",title: "Quantity", type: "number", width: 50,filtering: false},
				{ name: "BDD_REMARKS",title: "Remarks", type: "text", width: 150,filtering: false },
				{ type: "control" }
			]
			
		});
		
	});

	
});

}
