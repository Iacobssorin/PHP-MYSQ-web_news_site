//var ip='71.61.182.230';

function empty_validation(content,name){
    if ( $.trim(content) == '' )
    {
        alert(name+" must be fill out");
        return false;
    }
    return true;
}
    
function createNew() {
	var name=$('#name').val();
	var comment=$('#message-content').val();
	if(empty_validation(name,'name')){
		if(empty_validation(comment,'comment')){
	    //var url='http://'+ip+'/php5test/PHP/Create.php';
		    var url='./PHP/Create.php';
		    $.ajax({
		           url: url,
		           data: "name="+name+"&comment="+comment,
		           type: 'GET',
		           success: function (resp) {
		           		//alert(resp);	
		           		$('#name').value="";
						$('#message-content').value="";
		           		showAll();		
		           },
		           error: function(e) {
		           alert('Error: '+e);
		           },
		           complete:function(){
		            $('#msgform').each(function(){
		                this.reset();   //Here form fields will be cleared.
		            });
		       }
		    });
		}
	}
}


 function showAll() {
    //var url='http://'+ip+'/php5test/PHP/Show.php';
    var url='./PHP/Show.php';
    $.ajax({
           url: url,
           type: 'GET',
           success: function (resp) {
           		document.getElementById('message-ul').innerHTML = resp;
           		
           },
           error: function(e) {
           alert('Error: '+e);
           }
    });
}


	function deleteMsg(delItem) {
        var url='./PHP/Delete.php';
        $.ajax({
               url: url,
               data: "deleteItem="+delItem,
               type: 'GET',
            success: function (resp) {
            	showAll();
            },
            error: function(e) {
                    alert('Error: '+e);
            }
        });
    }
    
  
window.onload=function() {
	showAll();
	$('#submit').on('click',function(){
		createNew();
	});



}
