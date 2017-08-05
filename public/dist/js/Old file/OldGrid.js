 $(function() {
    $.ajax({
        type: "GET",
        url: "/datalist/BudgetHead.php"
		}).done(function(BudgetHead) {
        BudgetHead.unshift({ bhead_id: "0", bhead_name: "" });
		var MyDateField = function (config) {
        jsGrid.Field.call(this, config);
    };

    MyDateField.prototype = new jsGrid.Field({
        sorter: function (date1, date2) {
            return new Date(date1) - new Date(date2);
        },
       
        itemTemplate: function (value) {
			
           // debugger;
            return new Date(value).getFullYear();
        },

        insertTemplate: function (value) {
            return this._insertPicker = $("<input>").datepicker({
                 format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    minViewMode: "years",
	 autoclose: true
            });
        },

        editTemplate: function (value) {
            return $("<input>").datepicker({
                 format: " yyyy", // Notice the Extra space at the beginning
				 
    viewMode: "years", 
    minViewMode: "years",
	 autoclose: true
            }).datepicker('update',new Date(value));
        },
       
        insertValue: function () {
            return this._insertPicker.datepicker({
                format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    minViewMode: "years",
	 autoclose: true
            }).val();
        },
       
         editValue: function () {
			 /*.log("XXX");
            return this._editPicker.datepicker({
               // format: 'MM/DD/YYYY'
            }).val();*/
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
                        url: "/datalist/BudgetData/",
                        data: filter
					});
				},
                insertItem: function(item) {
					//console.log("IN");
                    return $.ajax({
                        type: "POST",
                        url: "/datalist/BudgetData/",
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
                        url: "/datalist/BudgetData/",
                        data: item,
						success:function(data2) {
						console.log(data2); 
						}
					});
				},
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/datalist/BudgetData/",
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
	
	// Budget Grid Master
	$.ajax({
        type: "GET",
        url: "/datalist/BudgetType.php"
		}).done(function(BudgetType) {
		$.ajax({
			type: "GET",
			url: "/datalist/BudgetMasterHead.php"
			}).done(function(BudgetMasterHead) {
			$.ajax({
				type: "GET",
				url: "/datalist/BudgetSupplier.php"
				}).done(function(BudgetSupplier) {
		BudgetSupplier.unshift({ ven_id: "0", ven_name: "Select" });			
		BudgetMasterHead.unshift({ bhead_id: "0", bhead_name: "Select" });
		BudgetType.unshift({ budget_type_id: "0", budget_type_name: "Select" });
		var MyDateField = function (config) {
        jsGrid.Field.call(this, config);
    };
	var MyFullDateField = function (config) {
        jsGrid.Field.call(this, config);
    };



    MyDateField.prototype = new jsGrid.Field({
        sorter: function (date1, date2) {
            return new Date(date1) - new Date(date2);
        },
       
        itemTemplate: function (value) {
			
           // debugger;
            return new Date(value).getFullYear();
        },

        insertTemplate: function (value) {
            return this._insertPicker = $("<input>").datepicker({
                 format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    minViewMode: "years",
	 autoclose: true
            });
        },

        editTemplate: function (value) {
            return $("<input>").datepicker({
                 format: " yyyy", // Notice the Extra space at the beginning
				 
    viewMode: "years", 
    minViewMode: "years",
	 autoclose: true
            }).datepicker('update',new Date(value));
        },
       
        insertValue: function () {
            return this._insertPicker.datepicker({
                format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    minViewMode: "years",
	 autoclose: true
            }).val();
        },
       
         editValue: function () {
			 /*.log("XXX");
            return this._editPicker.datepicker({
               // format: 'MM/DD/YYYY'
            }).val();*/
			return "2017";
        }
    });
		////New Date For \\\
	
	MyFullDateField.prototype = new jsGrid.Field({
        sorter: function (date1, date2) {
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
			 
            return this._editPicker.datepicker({
               // format: 'MM/DD/YYYY'
            }).val();
			
        }
    });
	jsGrid.fields.myfullDateField = MyFullDateField;
	////New Date For End \\\
	jsGrid.fields.myDateField = MyDateField;
        $("#jsGridBudgetMaster").jsGrid({
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
                        url: "/datalist/BudgetMasterData/",
                        data: filter
					});
				},
                insertItem: function(item) {
					//console.log("IN");
                    return $.ajax({
                        type: "POST",
                        url: "/datalist/BudgetMasterData/",
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
                        url: "/datalist/BudgetMasterData/",
                        data: item,
						success:function(data2) {
						console.log(data2); 
						}
					});
				},
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "/datalist/BudgetMasterData/",
                        data: item
					});
				}
			},
            fields: [
				{ name: "BSM_ID",title: "Budget Master ID", type: "number", width: 50,filtering: false},
				{ name: "BD_SERIAL_TYPE",title: "Budget Type", type: "select", items: BudgetType, valueField: "budget_type_id", textField: "budget_type_name" },
				{ name: "BD_SERIAL_YEAR",myCustomProperty: "bar", title: "Budget Year", type: "myDateField", width: 50,filtering: false },
				{ name: "BSM_HEAD",title: "Budget Head", type: "select", items: BudgetMasterHead, valueField: "bhead_id", textField: "bhead_name" },
				{ name: "BD_SERIAL_ISSUE_DATE",myCustomProperty: "bar", title: "Budget Issue Date", type: "myfullDateField", width: 50,filtering: false },
				{ name: "BSM_USD",title: "Budget Amount(USD)", type: "number", width: 100,filtering: false},
				{ name: "BSM_BD",title: "Budget Amount (BDT)", type: "number", width: 100,filtering: false, validate: "required"},
				{ name: "BSM_SUP_VEN",title: "Supplier", type: "select", items: BudgetSupplier, valueField: "ven_id", textField: "ven_name" },
				{ name: "BDD_QTY",title: "Quantity", type: "number", width: 50,filtering: false},
				{ name: "BSM_MUNIT",title: "Units", type: "text", width: 50,filtering: false},
				{ name: "BDD_REMARKS",title: "Remarks", type: "text", width: 100,filtering: false },
				{ type: "control" }
			]
		});
		
	});
	});
 });
	
});
