// JavaScript Document
function print_view_changer(size) {
    var layout = document.getElementById("print0");
	
	if(size == "landscape") {
		layout.style.width = "1050px";
		layout.style.height = "695px";
	}
	else {
		layout.style.width = "825.6px";
		layout.style.height = "1113.6px";
	}
	
	page_Deassign();
	
	var size = document.getElementById("plist0").childNodes.length;
    printarea = document.getElementById("print0");
    size--;
	var no_page = 1;
	var table_name = "print0";
	
    while(printarea != null){
        if(printarea.scrollHeight > printarea.offsetHeight){
        	page_assign("main", no_page, size,no_page,printarea,table_name);
        }
        if(document.getElementById("print"+no_page) == null) {
            break;
		}
        size = document.getElementById("plist"+no_page).childNodes.length;
        size--;
        table_name = "print"+no_page;
        printarea = document.getElementById("print"+no_page);
        no_page++;
    }
	
}

function page_Deassign(){
    i=1;
    while(document.getElementById("print"+i) != null){
        if(document.getElementById("plist"+i) !=null){
        	size=0;
        	limit=document.getElementById("plist"+i).childNodes.length;
       		while(size<limit) {
				document.getElementById("plist0").append(document.getElementById("plist"+i).childNodes[0]);
                size++;
            }
        }
        document.getElementById("print"+i).remove();
        if(i!=1) {
        	document.getElementById("printpage"+i).remove();
		}
        i++;
    }
    if(document.getElementById("plist"+i) == null && (document.getElementById("payment_terms") ==null || document.getElementById("sales_delivery_challan") ==null)){
        ii=1;
        while(document.getElementById("print"+ii) != null){
            document.getElementById("print0").innerHTML +=document.getElementById("print"+ii).innerHTML;
            document.getElementById("print"+ii).remove();
            ii++;
        }
		// Remove unwanted page breaks
		while(document.getElementById("printarea").lastChild.id != "print0"){ document.getElementById("printarea").lastChild.remove();}
    }
}

function page_assign(content, challan_number, size,no_page,printarea,table_name) {
	var i = 0;
	if(printarea != null)
    while((printarea.scrollHeight > printarea.offsetHeight) || content == "sales_tax" || content == "challan"){
			if(i == 0) {
				page_break = document.createElement("div");
					page_break.className = "page-break";
					page_break.id = "printpage"+no_page;
						document.getElementById("printarea").append(page_break);
						
				print_area = document.createElement("div");
				print_area.className="printout_div";
				print_area.id="print"+no_page;
				
				var prev = "";
				if(content == "main") {
					prev = "print"+(parseInt(no_page) - 1);
				}
				
				if(document.getElementById(prev) != null) {
						print_area.style.width=document.getElementById(prev).style.width;
						print_area.style.height=document.getElementById(prev).style.height;
				}
				
				var inner = "<table class='outer_table' cellpadding='0' cellspacing='0' style='width: 100%; border-top: 1px solid #000; margin-top: 60px;'>";
				if(document.getElementById("headings") != null) {
					inner = inner+"<thead>"+document.getElementById("headings").innerHTML+"</thead>";  
				}				
				print_area.innerHTML = inner+"<tbody id='plist"+no_page+"'></tbody></table>";
				
				document.getElementById("printarea").append(print_area);		
			}
			else{
				if(document.getElementById("print"+no_page)==null){
					page_break = document.createElement("div");
					page_break.className = "page-break";
					page_break.id = "printpage"+no_page;
					if(no_page != 1) {
						document.getElementById("printarea").append(page_break);
					}
					print_area = document.createElement("div");
					print_area.className = "printout_div ";
					print_area.id = "print"+no_page;
					
					var inner = "<table class='outer_table' cellpadding='0' cellspacing='0' style='width: 100%; border-top: 1px solid #000;'>";
					if(document.getElementById("headings") != null) {
						inner = inner+"<thead>"+document.getElementById("headings").innerHTML+"</thead>";  
					}				
					print_area.innerHTML = inner+"<tbody id='plist"+no_page+"'></tbody></table>";
					
					document.getElementById("printarea").append(print_area);
				}
				
				var taken = "";
				if(content == "main") {
					taken = "plist"+(no_page-1);
				}
				if(document.getElementById(taken) == null) { break; }
				document.getElementById("plist"+no_page).insertBefore(document.getElementById(taken).lastChild,document.getElementById("plist"+no_page).firstChild);
				
				size--;
				
			}
		i++;
	}
}