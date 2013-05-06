<html>
	<script>

// add relevant message above or remove the line if not required
window.onload = function(){
    if(window.opener){
    	window.opener.location.href  = "/employer/payment/complete";
        window.close();
    }
    else{
        if(top.dg.isOpen() == true){
            top.dg.closeFlow();
            
        }
    }

     
};                    

                                
</script>
</html>